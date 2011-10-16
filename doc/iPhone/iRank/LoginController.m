//
//  LoginController.m
//  iRank
//
//  Created by Luciano Stegun on 01/05/2011.
//  Copyright 2011 __MyCompanyName__. All rights reserved.
//

#import "LoginController.h"
#import "iRankAppDelegate.h"
#import <CommonCrypto/CommonDigest.h>
#import "JSON.h"
#import "Constants.h"
#import "RankingViewController.h"

@implementation LoginController

@synthesize signButton;
@synthesize signView;
@synthesize txtUsername;
@synthesize txtPassword;
@synthesize activityIndicator;
@synthesize appDelegate;

//@synthesize connection;
//@synthesize url;
//@synthesize request;

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
    
    txtUsername.clearButtonMode = UITextFieldViewModeWhileEditing;
    txtPassword.clearButtonMode = UITextFieldViewModeWhileEditing;
    
    appDelegate = [[UIApplication sharedApplication] delegate];
    
    [super viewDidLoad];
    // Do any additional setup after loading the view from its nib.
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
    return (interfaceOrientation == UIInterfaceOrientationPortrait);
}

- (void)doLogin {
    
    if( [txtUsername.text isEqualToString:@""] || [txtPassword.text isEqualToString:@""])
        return;
    
    activityIndicator.hidden = NO;
    txtUsername.enabled = NO;
    txtPassword.enabled = NO;
    signButton.enabled = NO;
    
    NSString *urlString;
    urlString = @"http://irank/index.php/login/login/mobile/1/username/";
    urlString = [urlString stringByAppendingString:txtUsername.text];
    urlString = [urlString stringByAppendingString:@"/password/"];
    urlString = [urlString stringByAppendingString:[self getMD5FromString:txtPassword.text]];
    
    NSString *data = [[NSString alloc] initWithContentsOfURL:[NSURL URLWithString:urlString]];
    
    [self handleLoginResult:data];
}

- (void)handleLoginResult:(NSString *)result {
    
    activityIndicator.hidden = YES;
    txtUsername.enabled = YES;
    txtPassword.enabled = YES;
    signButton.enabled = YES;
    
    NSLog(@"Login result: %@", result);
    
    if( [result isEqualToString:@"error"] ){
        
        UIAlertView *alert = [[[UIAlertView alloc] initWithTitle:@"Acesso negado" message:@"Usuário/Senha inválidos!" delegate:self cancelButtonTitle:@"Tentar novamente" otherButtonTitles:nil] autorelease];
        
        [alert show];
        return;
    }
    
    NSString *userSiteId = result;
    
    if( userSiteId==nil || userSiteId==NULL ){
        
        UIAlertView *alert = [[[UIAlertView alloc] initWithTitle:@"Erro" message:@"Ocorreu um erro ao se conectar ao iRank!" delegate:self cancelButtonTitle:@"Tentar novamente" otherButtonTitles:nil] autorelease];
        
        [alert show];
        return;
    }
    
    [appDelegate.defaults setObject:userSiteId forKey:kUserSiteIdKey];
    [appDelegate.defaults synchronize];
    
    appDelegate.window.rootViewController = appDelegate.tabBarController;
    
    [userSiteId release];
}

- (void)signButtonTouchUp:(id)sender {
    

    appDelegate.window.rootViewController = appDelegate.tabBarController;

}

-(BOOL)textFieldShouldReturn:(UITextField *) textField {
    
    [textField resignFirstResponder];
    
    [self doLogin];
    
    return YES;
}

- (NSString *) getMD5FromString:(NSString *)str {
    const char *cStr = [str UTF8String];
    unsigned char result[16];
    CC_MD5( cStr, strlen(cStr), result );
    return [NSString stringWithFormat:
            @"%02X%02X%02X%02X%02X%02X%02X%02X%02X%02X%02X%02X%02X%02X%02X%02X",
            result[0], result[1], result[2], result[3], 
            result[4], result[5], result[6], result[7],
            result[8], result[9], result[10], result[11],
            result[12], result[13], result[14], result[15]
            ]; 
}


- (void)dealloc {
    
    [signButton release];
    [signView release];
    [txtUsername release];
    [txtPassword release];
    [activityIndicator release];
//    [connection release];
//    [request release];
//    [url release];
    [super dealloc];
}

@end
