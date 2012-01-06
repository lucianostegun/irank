//
//  EventCommentViewController.m
//  iRank
//
//  Created by Luciano Stegun on 01/05/2011.
//  Copyright (c) 2011 __MyCompanyName__. All rights reserved.
//

#import "iRankAppDelegate.h"
#import "EventCommentViewController.h"

@implementation EventCommentViewController
@synthesize webView;
@synthesize eventId, lastEventId;

- (id)initWithNibName:(NSString *)nibNameOrNil bundle:(NSBundle *)nibBundleOrNil
{
    self = [super initWithNibName:nibNameOrNil bundle:nibBundleOrNil];
    if (self) {
        // Custom initialization
    }
    return self;
}

- (void)didReceiveMemoryWarning
{
    // Releases the view if it doesn't have a superview.
    [super didReceiveMemoryWarning];
    
    // Release any cached data, images, etc that aren't in use.
}

#pragma mark - View lifecycle

-(void)viewWillAppear:(BOOL)animated {
    
    [[NSNotificationCenter defaultCenter] 
     addObserver:self selector:@selector
     (keyboardWillAppear:) name:UIKeyboardWillShowNotification object:self.view.window];
    
    [[NSNotificationCenter defaultCenter] 
     addObserver:self selector:@selector
     (keyboardWillDisappear:) name:UIKeyboardWillHideNotification object:self.view.window];
    
    [self setTitle:@"Comentários"];
    
    if( eventId!=lastEventId ){
        
        [webView loadHTMLString:@"" baseURL:nil];
        lastEventId = eventId;
        
        [self doRefreshWebView:YES];
    }
}

-(void)viewDidDisappear:(BOOL)animated {
    

}

-(void)viewDidAppear:(BOOL)animated {
    
    [super viewDidAppear:animated];
}

-(void)viewWillDisappear:(BOOL)animated {
    
    [[NSNotificationCenter defaultCenter] removeObserver:self name: UIKeyboardWillShowNotification object:nil];
    [[NSNotificationCenter defaultCenter] removeObserver:self name: UIKeyboardWillHideNotification object:nil];
    [self.view endEditing:YES];
}

- (void)viewDidLoad
{
    [super viewDidLoad];
    
//    UIBarButtonItem *refreshButton = [[UIBarButtonItem alloc] initWithTitle:@"Atualizar" style:UIBarButtonItemStyleBordered target:self action:@selector(refreshWebView:)];
    
    activityIndicator = [[UIActivityIndicatorView alloc] initWithActivityIndicatorStyle:UIActivityIndicatorViewStyleWhite];
    [activityIndicator setHidesWhenStopped:YES];
    [activityIndicator setHidden:YES];
    
    UIBarButtonItem * barButton =  [[UIBarButtonItem alloc] initWithCustomView:activityIndicator];
    
    self.navigationItem.rightBarButtonItem = barButton;
    
    self.navigationController.navigationBar.barStyle = UIBarStyleBlackOpaque;
//    self.navigationItem.rightBarButtonItem = refreshButton;
    
    [self doRefreshWebView:YES];
}

-(void)doRefreshWebView:(BOOL)fullRefresh {

    if( fullRefresh ){
        
        NSString *urlAddress = [NSString stringWithFormat:@"http://%@/ios.php/event/comments/eventId/%i#footer", serverAddress, eventId];
        NSURL *url = [NSURL URLWithString:urlAddress];
    
        NSURLRequest *request = [NSURLRequest requestWithURL:url];
    
        [webView loadRequest:request];
    }else{

        [webView reload];   
    }
}

-(void)refreshWebView:(id)sender {
    
    [self doRefreshWebView:NO];
}

- (void)viewDidUnload
{
    [super viewDidUnload];
    // Release any retained subviews of the main view.
    // e.g. self.myOutlet = nil;
}

- (BOOL)shouldAutorotateToInterfaceOrientation:(UIInterfaceOrientation)interfaceOrientation
{
    // Return YES for supported orientations
    return YES;//(interfaceOrientation == UIInterfaceOrientationPortrait);
}

- (void)keyboardWillAppear: (NSNotification *)notif {
    
    NSDictionary* info  = [notif userInfo];
    NSValue *aValue     = [info objectForKey:UIKeyboardBoundsUserInfoKey];
    CGSize keyboardSize = [aValue CGRectValue].size;
    
    float bottomPoint = (toolbar.frame.origin.y + toolbar.frame.size.height);// - self.tabBarController.tabBar.frame.size.height);
    scrollAmount      = keyboardSize.height - (self.view.frame.size.height - bottomPoint);
    
    if(scrollAmount > 0) {
        moveViewUp = YES;
        [self scrollTheView:YES];
    }else
        moveViewUp = NO;
}

- (void)keyboardWillDisappear: (NSNotification *)notif {
    
    moveViewUp = NO;
    [self scrollTheView:NO];
}



- (void)scrollTheView: (BOOL)movedUp {
    
    /*
     beginAnimations:: possui argumentos para passar informacão ao delegate da animação.
     Já que não vou usar nenhum delegate na aplicação, devo setar os argumentos para nil ou NULL.
     
     nil é usado quando há um ponteiro null para um objeto
     NULL é usado quando há um ponteiro null para qualquer outra coisa 
     */
    [UIView beginAnimations:nil context:NULL];
    CGRect rect = self.view.frame;
    
    if(movedUp){
        
        [UIView setAnimationDuration:0.3];
        rect.origin.y -= scrollAmount;
    }else{
        
        [UIView setAnimationDuration:0.25];
        rect.origin.y += scrollAmount;
    }
    
    self.view.frame = rect;
    [UIView commitAnimations];
}

-(BOOL)textFieldShouldReturn:(UITextField *) theTextField {
    
//    [theTextField resignFirstResponder];
    
    return YES;
}

- (BOOL)textField:(UITextField *)textField shouldChangeCharactersInRange:(NSRange)range replacementString:(NSString *)string {
    
    NSUInteger newLength = [textField.text length] + [string length] - range.length;
    
    if( newLength > 0 )
        btnSend.enabled = YES;
    else
        btnSend.enabled = NO;
    
    return (newLength > 140) ? NO : YES;
}


//- (void)touchesBegan:(NSSet *)touches withEvent:(UIEvent *)event {
//          
//    if( txtMessage.editing ){
//        
//        [txtMessage resignFirstResponder];
//        [self scrollTheView:NO];
//        
////        webView.userInteractionEnabled = YES;
//    }
//    
//    [super touchesBegan:touches withEvent:event];
//}

-(void)sendMessage:(id)sender {
    
    if( [txtMessage.text isEqualToString:@""] ){
     
        btnSend.enabled = NO;
        return;
    }
    
    [self.view endEditing:YES];
    
    [activityIndicator setHidden:NO];
    [activityIndicator startAnimating];

//    NSLog(@"Enviando mensagem");
    
    int userSiteId = [(iRankAppDelegate *)[[UIApplication sharedApplication] delegate] userSiteId];
    
    NSString *post = [[NSString alloc] initWithFormat:@"eventId=%i&userSiteId=%i&comment=%@", eventId, userSiteId, txtMessage.text];
    
    NSData *postData = [post dataUsingEncoding:NSASCIIStringEncoding allowLossyConversion:YES];  
    
    NSString *postLength = [NSString stringWithFormat:@"%d", [postData length]];  
    
    NSURL *url = [NSURL URLWithString:[NSString stringWithFormat:@"http://%@/ios.php/event/saveComment", serverAddress]];
    NSMutableURLRequest *theRequest = [NSMutableURLRequest requestWithURL:url];
    [theRequest setHTTPMethod:@"POST"];  
    [theRequest setValue:postLength forHTTPHeaderField:@"Content-Length"];  
    [theRequest setHTTPBody:postData];     
    
    [[NSURLConnection alloc] initWithRequest:theRequest delegate:self];
    
    btnSend.enabled    = NO;
    txtMessage.enabled = NO;
    
}

- (void)connection: (NSURLConnection *)connection didReceiveResponse:(NSURLResponse *)response {
    
    NSLog(@"didReceiveResponse");
//    [activityIndicator setHidden:YES];
}

- (void)connection: (NSURLConnection *)connection didReceiveData:(NSData *)data {
    
    NSLog(@"didReceiveData");
    
    NSString *result = [[NSString alloc] initWithData:data encoding:NSASCIIStringEncoding];
    
    
    
    NSLog(@"result: %@", result);
    
    [result release];
    
}

- (void)connectionDidFinishLoading:(NSURLConnection *)connection {

    NSLog(@"connectionDidFinishLoading");
    btnSend.enabled    = NO;
    txtMessage.enabled = YES;
    txtMessage.text    = nil;
    
    [self doRefreshWebView:NO];
    [activityIndicator stopAnimating];
    
//    moveViewUp = NO;
//    [self scrollTheView:NO];
}

- (void)webView:(UIWebView *)webView didFailLoadWithError:(NSError *)error {
    
    NSLog(@"Ocorreu um erro ao carregar a página: %@", error);
}

@end
