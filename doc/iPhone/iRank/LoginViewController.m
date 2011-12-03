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
    // Do any additional setup after loading the view from its nib.
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
    
    NSString *urlString  = [NSString stringWithFormat:@"http://%@/ios.php/login/doLogin/username/%@/password/%@", serverAddress, txtUsername.text, txtPassword.text];
    
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
    
    iRankAppDelegate *appDelegate = (iRankAppDelegate *)[[UIApplication sharedApplication] delegate];
    
    if( [result isEqualToString:@"denied"] ) 
        return [appDelegate showAlert:@"Acesso negado" message:@"Usuário/Senha inválidos!\nPor favor, tente novamente."];

    if( [result isEqualToString:@"error"] ) 
        return [appDelegate showAlert:@"Erro" message:@"Ocorreu um erro na identificação!\nPor favor, tente novamente."];
    
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
    
    iRankAppDelegate *appDelegate = (iRankAppDelegate *)[[UIApplication sharedApplication] delegate];
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

-(void)dealloc {

    [txtUsername release];
    [txtPassword release];
    [activityIndicator release];
    [super dealloc];
}
@end
