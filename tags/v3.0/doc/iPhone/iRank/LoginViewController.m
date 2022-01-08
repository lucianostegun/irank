//
//  LoginViewController.m
//  iRank
//
//  Created by Luciano Stegun on 01/05/2011.
//  Copyright 2011 __MyCompanyName__. All rights reserved.
//

#import "LoginViewController.h"
#import "iRankAppDelegate.h"
#import "JSON.h"
#import "SignViewController.h"

@implementation LoginViewController

@synthesize activityIndicator;
@synthesize txtUsername, txtPassword;

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

- (void)viewDidLoad
{
    [super viewDidLoad];
    appDelegate = (iRankAppDelegate *)[[UIApplication sharedApplication] delegate];
    
    [txtUsername setPlaceholder: NSLocalizedString(@"Username/E-mail", @"login")];
    [txtPassword setPlaceholder: NSLocalizedString(@"Password", @"login")];
    
    [btnRecoveryPassword setTitle: NSLocalizedString(@"recovery password", @"login") forState:UIControlStateNormal];
    [btnSign setTitle: NSLocalizedString(@"free register", @"login") forState:UIControlStateNormal];
    
    [developerCredit setText: NSLocalizedString(@"developed by", @"login")];
    [about setText: NSLocalizedString(@"about", @"login")];
}

- (void)viewDidUnload
{
    [super viewDidUnload];
    // Release any retained subviews of the main view.
    // e.g. self.myOutlet = nil;
}

- (void)viewWillAppear:(BOOL)animated {
    
//    txtUsername.text = @"lstegun";
//    txtPassword.text = @"unidunite";
    
    if( signViewController!=nil && signViewController.signSuccess ){
     
        txtUsername.text = signViewController.username;
        txtPassword.text = signViewController.password;
        [self doLogin:nil];
    }
}

- (BOOL)shouldAutorotateToInterfaceOrientation:(UIInterfaceOrientation)interfaceOrientation
{
    // Return YES for supported orientations
    return (interfaceOrientation == UIInterfaceOrientationPortrait);
}

- (BOOL)textFieldShouldReturn:(UITextField *)textField {
    
    [textField resignFirstResponder];
    
    if( ![txtUsername.text isEqualToString:@""] && ![txtPassword.text isEqualToString:@""] )
        [self doLogin:textField];
    
    return YES;
}

#pragma mark - Login

- (void)doLogin:(id)sender {

    [activityIndicator setHidden:NO];
    [txtUsername setEnabled:NO];
    [txtPassword setEnabled:NO];
    
    NSString *urlString  = [NSString stringWithFormat:@"http://%@/ios.php/login/doLogin/username/%@/password/%@/language/%@", serverAddress, txtUsername.text, txtPassword.text, appDelegate.currentLanguage];
    
    NSURL *url = [NSURL URLWithString:urlString];
    
    NSURLRequest *request = [NSURLRequest requestWithURL:url];

    [NSURLConnection connectionWithRequest:request delegate:self];
//    NSLog(@"urlString: %@", urlString);
}

- (void)connection: (NSURLConnection *)connection didReceiveResponse:(NSURLResponse *)response {
    
//    NSLog(@"didReceiveResponse");
    [activityIndicator setHidden:YES];
}

- (void)connection: (NSURLConnection *)connection didReceiveData:(NSData *)data {
    
//    NSLog(@"didReceiveData");

    NSString *result = [[NSString alloc] initWithData:data encoding:NSASCIIStringEncoding];

    NSLog(@"result: %@", result);
    
    if( [result isEqualToString:@"denied"] ) 
        return [appDelegate showAlert:NSLocalizedString(@"Access denied", @"alert") message:NSLocalizedString(@"Invalid Username/Password!\nPlease, try again", @"login")];

    if( [result isEqualToString:@"error"] ) 
        return [appDelegate showAlert:NSLocalizedString(@"Error", @"alert") message:NSLocalizedString(@"Login error!\nPlease, try again.", @"login")];
    
    NSMutableDictionary *dictionary = [[NSMutableDictionary alloc] init];
    
    SBJsonParser *jsonParser = [[SBJsonParser alloc] init];
    NSDictionary *jsonObjects = [jsonParser objectWithString:result error:nil];

    [dictionary setObject:[jsonObjects objectForKey:@"id"] forKey:kUserSiteIdKey];
    [dictionary setObject:[jsonObjects objectForKey:kFeeKey] forKey:kFeeKey];
    [dictionary setObject:[jsonObjects objectForKey:kBuyinKey] forKey:kBuyinKey];
    [dictionary setObject:[jsonObjects objectForKey:kAddonKey] forKey:kAddonKey];
    [dictionary setObject:[jsonObjects objectForKey:kRebuyKey] forKey:kRebuyKey];
    [dictionary setObject:[jsonObjects objectForKey:kPrizeKey] forKey:kPrizeKey];
    [dictionary setObject:[jsonObjects objectForKey:kScoreKey] forKey:kScoreKey];
    [dictionary setObject:[jsonObjects objectForKey:kBalanceKey] forKey:kBalanceKey];
    [dictionary setObject:[jsonObjects objectForKey:kFirstNameKey] forKey:kFirstNameKey];
    [dictionary setObject:[jsonObjects objectForKey:kLastNameKey] forKey:kLastNameKey];
    
    [[appDelegate userDefaults] setObject:dictionary forKey:@"userInfo"];
    [[appDelegate userDefaults] synchronize];
    
    [dictionary release];
    
    [self switchLogin];
}

- (void)connectionDidFinishLoading:(NSURLConnection *)connection {
    
//    NSLog(@"connectionDidFinishLoading");

    [txtUsername setEnabled:YES];
    [txtPassword setEnabled:YES];
}

-(void)switchLogin {
    
    [appDelegate switchLogin];
}

-(void)showInfoView:(id)sender {
    
	[UIView beginAnimations:nil context:nil];
	[UIView setAnimationDuration:1.0];
	[UIView setAnimationTransition:UIViewAnimationTransitionFlipFromRight
						   forView:[self view]
							 cache:YES];

    [self.view addSubview:infoView];
    [UIView commitAnimations];
}

-(void)hideInfoView:(id)sender {
    
	[UIView beginAnimations:nil context:nil];
	[UIView setAnimationDuration:1.0];
	[UIView setAnimationTransition:UIViewAnimationTransitionFlipFromRight
						   forView:[self view]
							 cache:YES];
    
    [infoView removeFromSuperview];
    [UIView commitAnimations];
}

-(void)showSignView:(id)sender {

    if( signViewController==nil )    
        signViewController = [[SignViewController alloc] initWithStyle:UITableViewStyleGrouped];
    
    [self.navigationController pushViewController:signViewController animated:YES];
}

-(void)recoverPassword:(id)sender {
    
    if( [txtUsername.text isEqualToString:@""] ){
     
        [appDelegate showAlert:NSLocalizedString(@"Error", @"alert") message:NSLocalizedString(@"Type your username or e-mail to recover your password!", @"login")];
        return;
    }
    
    [self.view endEditing:YES];
    
    [activityIndicator setHidden:NO];
    [activityIndicator startAnimating];
    
    [self performSelector:@selector(doRecoverPassword) withObject:nil afterDelay:0.1];
}


-(void)doRecoverPassword {
    
    NSURL *url                   = [NSURL URLWithString:[NSString stringWithFormat:@"http://%@/ios.php/login/recoveryPassword/username/%@/language/%@", serverAddress, txtUsername.text, appDelegate.currentLanguage]];
    NSLog(@"url: %@", url);
    NSMutableURLRequest *request = [NSMutableURLRequest requestWithURL:url cachePolicy:NSURLRequestReloadIgnoringCacheData timeoutInterval:45];
  	NSError *requestError        = nil;
    NSData *response             = [NSURLConnection sendSynchronousRequest:request returningResponse:nil error:&requestError]; 
    
    if( requestError==nil ){
        
        NSString *result = [[NSString alloc] initWithData:response encoding:NSASCIIStringEncoding];
        
        if( [result isEqualToString:@"recoverySuccess"] )
            [appDelegate showAlert:NSLocalizedString(@"Success", @"alert") message:NSLocalizedString(@"A new password was sent to your e-mail address.", @"login")];
        else
            [appDelegate showAlert:NSLocalizedString(@"Error", @"alert") message:NSLocalizedString(@"Username/E-mail not found", @"login")];
    }else{
     
        [appDelegate showAlert:NSLocalizedString(@"Fail", @"alert") message:NSLocalizedString(@"We could not recovery your password!\nPlease, try again", @"login")];
    }
    
    [activityIndicator stopAnimating];
    [activityIndicator setHidden:YES];
}

-(void)dealloc {

    [txtUsername release];
    [txtPassword release];
    [activityIndicator release];
    [super dealloc];
}
@end
