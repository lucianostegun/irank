//
//  iRankAppDelegate.m
//  iRank
//
//  Created by Luciano Stegun on 01/05/2011.
//  Copyright 2011 __MyCompanyName__. All rights reserved.
//

#import "iRankAppDelegate.h"

@implementation iRankAppDelegate

@synthesize window = _window;
@synthesize tabBarController;
@synthesize loginViewController;
@synthesize userDefaults;

- (BOOL)application:(UIApplication *)application didFinishLaunchingWithOptions:(NSDictionary *)launchOptions
{

    userDefaults = [NSUserDefaults standardUserDefaults];
    NSDictionary *userInfo = [userDefaults objectForKey:@"userInfo"];

    if( userInfo==nil ){

        loginViewController = [[LoginViewController alloc] init];
        self.window.rootViewController = loginViewController;
        [loginViewController release];
    }else{
        
        [self switchLogin];
    }
    
    [userInfo release];
    
    [self.window makeKeyAndVisible];
    
//    NSLog(@"retainCount: %i", [loginViewController retainCount]);

    return YES;
}

-(void)switchLogin {
    
    self.window.rootViewController = tabBarController;
    
    //    NSLog(@"retainCount: %i", [loginViewController retainCount]);
}

-(void)showLogin {
    
    if( loginViewController==nil )
        loginViewController = [[LoginViewController alloc] init];
    
    self.window.rootViewController = nil;
    self.window.rootViewController = loginViewController;
    [loginViewController release];
    loginViewController = nil;
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

- (void)dealloc
{
    [loginViewController release];
    [tabBarController release];
    [_window release];
    [userDefaults release];
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
