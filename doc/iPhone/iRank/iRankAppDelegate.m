//
//  iRankAppDelegate.m
//  iRank
//
//  Created by Luciano Stegun on 01/05/2011.
//  Copyright 2011 __MyCompanyName__. All rights reserved.
//

#import "iRankAppDelegate.h"
#import "HomeViewController.h"
#import "ConfigViewController.h"
#import "Constants.h"

@implementation iRankAppDelegate

@synthesize window = _window;
@synthesize tabBarController;
@synthesize loginViewController;
@synthesize userDefaults;
@synthesize homeTabBar;
@synthesize userSiteId;
@synthesize firstName, lastName;
@synthesize refreshHome;

- (BOOL)application:(UIApplication *)application didFinishLaunchingWithOptions:(NSDictionary *)launchOptions
{

    userDefaults = [NSUserDefaults standardUserDefaults];
    NSDictionary *userInfo = [userDefaults objectForKey:@"userInfo"];
    
    refreshHome = YES;
    
    userSiteId = [[userInfo objectForKey:kUserSiteIdKey] intValue];
    firstName = [userInfo objectForKey:kFirstNameKey];
    lastName = [userInfo objectForKey:kLastNameKey];
    
    if( userInfo==nil ){

        loginViewController = [[LoginViewController alloc] init];
        
        UINavigationController *navigationController = [[UINavigationController alloc] initWithRootViewController:loginViewController];
        [navigationController setNavigationBarHidden:YES];
        
        self.window.rootViewController = navigationController;
        [loginViewController release];
        loginViewController = nil;
    }else{
        
        [self switchLogin];
    }
    
    [userInfo release];
    
    [self.window makeKeyAndVisible];
    
    NSNumber *homeEvents = [userDefaults objectForKey:@"homeEvents"];
    
    // Se homeEvents for NULL então reestabelece todas as configurações iniciais
    if( homeEvents==NULL ){
     
        homeEvents = [NSNumber numberWithInt:5];
        [userDefaults setObject:homeEvents forKey:@"homeEvents"];
        [userDefaults setBool:YES forKey:@"saveResultOffline"];
        [userDefaults synchronize];
    }
    
    [homeEvents release];
    
    return YES;
}

-(void)putOnLandscapeMode {
    

}

-(void)switchLogin {
    
    refreshHome = YES;
    
    userDefaults = [NSUserDefaults standardUserDefaults];
    NSDictionary *userInfo = [userDefaults objectForKey:@"userInfo"];
    
    userSiteId = [[userInfo objectForKey:kUserSiteIdKey] intValue];
    firstName = [userInfo objectForKey:kFirstNameKey];
    lastName = [userInfo objectForKey:kLastNameKey];
    
    self.window.rootViewController = tabBarController;
    
}

-(void)showLogin {
    
    if( loginViewController==nil )
        loginViewController = [[LoginViewController alloc] init];
    
    UINavigationController *navigationController = [[UINavigationController alloc] initWithRootViewController:loginViewController];
    [navigationController setNavigationBarHidden:YES];
    
    self.window.rootViewController = nil;
    self.window.rootViewController = navigationController;
    
    [loginViewController release];
    loginViewController = nil;
    
    mainBadge = 0;
    [self updateBadge];
}

- (void)applicationWillResignActive:(UIApplication *)application
{
    /*
     Sent when the application is about to move from active to inactive state. This can occur for certain types of temporary interruptions (such as an incoming phone call or SMS message) or when the user quits the application and it begins the transition to the background state.
     Use this method to pause ongoing tasks, disable timers, and throttle down OpenGL ES frame rates. Games should use this method to pause the game.
     */
}

- (void)applicationDidEnterBackground:(UIApplication *)application
{
    /*
     Use this method to release shared resources, save user data, invalidate timers, and store enough application state information to restore your application to its current state in case it is terminated later. 
     If your application supports background execution, this method is called instead of applicationWillTerminate: when the user quits.
     */
}

- (void)applicationWillEnterForeground:(UIApplication *)application
{
    /*
     Called as part of the transition from the background to the inactive state; here you can undo many of the changes made on entering the background.
     */
}

- (void)applicationDidBecomeActive:(UIApplication *)application
{
    /*
     Restart any tasks that were paused (or not yet started) while the application was inactive. If the application was previously in the background, optionally refresh the user interface.
     */
}

- (void)applicationWillTerminate:(UIApplication *)application
{
    /*
     Called when the application is about to terminate.
     Save data if appropriate.
     See also applicationDidEnterBackground:.
     */
}

-(void)showAlert:(NSString *)title message:(NSString *)message {
    
    UIAlertView* alertView = [[UIAlertView alloc] initWithTitle:title message:message delegate:self cancelButtonTitle:@"OK" otherButtonTitles:nil];
    
    [alertView show];
    [alertView release];
}

-(void)incraseBadge:(int)amount {
    
    mainBadge += amount;
    [self updateBadge];
}

-(void)decraseBadge:(int)amount {
    
    mainBadge -= amount;
    [self updateBadge];
}

-(void)updateBadge {
    
    [[UIApplication sharedApplication] setApplicationIconBadgeNumber:mainBadge];
}

-(void)showNetworkActivity {
    
    [[UIApplication sharedApplication] setNetworkActivityIndicatorVisible:YES];
}

-(void)hideNetworkActivity {
    
    [[UIApplication sharedApplication] setNetworkActivityIndicatorVisible:NO];
}

-(void)showLoadingView:(NSString *)loadingMessage {
    
    if( loadingMessage==nil )
        loadingMessage = @"carregando lista de eventos...";
    
    lblLoadingMessage.text = loadingMessage;
    
    [self.window.rootViewController.view addSubview:loadingView];
    [self showNetworkActivity];
}

-(void)hideLoadingView {
    
    [loadingView removeFromSuperview];
    [self hideNetworkActivity];
}

- (void)dealloc
{
    [loginViewController release];
    [tabBarController release];
    [_window release];
    [userDefaults release];
    [homeTabBar release];
    [firstName release];
    [lastName release];
    [super dealloc];
}

/*
 // Optional UITabBarControllerDelegate method.
 - (void)tabBarController:(UITabBarController *)tabBarController didSelectViewController:(UIViewController *)viewController
 {
 }
 */

/*
 // Optional UITabBarControllerDelegate method.
 - (void)tabBarController:(UITabBarController *)tabBarController didEndCustomizingViewControllers:(NSArray *)viewControllers changed:(BOOL)changed
 {
 }
 */

@end
