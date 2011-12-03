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
#import "Reachability.h"

@implementation iRankAppDelegate

@synthesize window = _window;
@synthesize tabBarController;
@synthesize loginViewController;
@synthesize userDefaults;
@synthesize homeTabBar;
@synthesize userSiteId;
@synthesize firstName, lastName;
@synthesize refreshHome, refreshHomeEventList;
@synthesize internetActive, wifiConnection, hostActive;

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
        refreshHomeEventList = NO;
    }else{
        
        refreshHomeEventList = YES;
        [self switchLogin];
    }
    
    [userInfo release];
    
    [self.window makeKeyAndVisible];
    
    NSNumber *homeEvents = [userDefaults objectForKey:kHomeEventLimitKey];
    
    // Se homeEvents for NULL então reestabelece todas as configurações iniciais
    if( homeEvents==NULL ){
     
        homeEvents = [NSNumber numberWithInt:10];
        [userDefaults setObject:homeEvents forKey:kHomeEventLimitKey];
        [userDefaults setBool:YES forKey:kSaveOfflineKey];
        [userDefaults setFloat  :50 forKey:kPhotoCompressKey];
        [userDefaults synchronize];
    }
    
    [homeEvents release];
    
    return YES;
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
    
    refreshHome = YES;

    [[NSNotificationCenter defaultCenter] removeObserver:self];
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
    
    
    // check for internet connection
    [[NSNotificationCenter defaultCenter] addObserver:self selector:@selector(checkNetworkStatus:) name:kReachabilityChangedNotification object:nil];
    
    internetReachable = [[Reachability reachabilityForInternetConnection] retain];
    [internetReachable startNotifier];
    
    // check if a pathway to a random host exists
    hostReachable = [[Reachability reachabilityWithHostName: serverAddress] retain];
    [hostReachable startNotifier];
    
    // now patiently wait for the notification
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

- (void) checkNetworkStatus:(NSNotification *)notice
{
    // called after network status changes
    
    NetworkStatus internetStatus = [internetReachable currentReachabilityStatus];
    switch( internetStatus ){
        case NotReachable:

            NSLog(@"The internet is down.");
            internetActive = NO;
            wifiConnection = NO;
            break;
        case ReachableViaWiFi:

            NSLog(@"The internet is working via WIFI.");
            internetActive = YES;
            wifiConnection = YES;
            break;
        case ReachableViaWWAN:

            NSLog(@"The internet is working via WWAN.");
            internetActive = YES;   
            wifiConnection = NO;         
            break;
    }
    
    NetworkStatus hostStatus = [hostReachable currentReachabilityStatus];
    switch( hostStatus ){
        case NotReachable:

            NSLog(@"A gateway to the host server is down.");
            hostActive = NO;            
            break;
        case ReachableViaWiFi:

            NSLog(@"A gateway to the host server is working via WIFI.");
            hostActive = YES;
            break;
        case ReachableViaWWAN:

            NSLog(@"A gateway to the host server is working via WWAN.");
            hostActive = YES;
            break;
    }
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
