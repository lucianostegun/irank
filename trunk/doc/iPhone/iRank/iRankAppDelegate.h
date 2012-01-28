//
//  iRankAppDelegate.h
//  iRank
//
//  Created by Luciano Stegun on 01/05/2011.
//  Copyright 2011 __MyCompanyName__. All rights reserved.
//

#import <UIKit/UIKit.h>
#import "LoginViewController.h"

@class Reachability;

@interface iRankAppDelegate : NSObject <UIApplicationDelegate> {
    
    IBOutlet UITabBarController *tabBarController;
    IBOutlet UITabBarItem *homeTabBar;
    IBOutlet UITabBarItem *eventsTabBar;
    IBOutlet UITabBarItem *rankingsTabBar;
    IBOutlet UITabBarItem *configTabBar;
    LoginViewController *loginViewController;
    NSUserDefaults *userDefaults;
    NSInteger mainBadge;
    
    IBOutlet UIView *loadingView;
    IBOutlet UILabel *lblLoadingMessage;
    
    Reachability* internetReachable;
    Reachability* hostReachable;
}

@property (nonatomic, retain) IBOutlet UIWindow *window;
@property (nonatomic, retain) IBOutlet UITabBarController *tabBarController;
@property (nonatomic, retain) IBOutlet UITabBarItem *homeTabBar;
@property (nonatomic, retain) LoginViewController *loginViewController;
@property (nonatomic, readonly) NSUserDefaults *userDefaults;
@property (nonatomic, readonly) int userSiteId;
@property (nonatomic, readonly) NSString *firstName;
@property (nonatomic, readonly) NSString *lastName;
@property (nonatomic, readwrite) BOOL refreshHome;
@property (nonatomic, readwrite) BOOL refreshEventList;
@property (nonatomic, readwrite) BOOL refreshRankingList;
@property (nonatomic, readonly) BOOL internetActive;
@property (nonatomic, readonly) BOOL wifiConnection;
@property (nonatomic, readonly) BOOL hostActive;
@property (nonatomic, readonly) NSString *currentLanguage;

- (void)switchLogin;
- (void)showLogin;
- (void)showAlert:(NSString *)title message:(NSString *)message;
- (void)setBadge:(int)amount;
- (void)incraseBadge:(int)amount;
- (void)decraseBadge:(int)amount;
- (void)updateBadge;
- (void)putOnLandscapeMode;
- (void)showNetworkActivity;
- (void)hideNetworkActivity;

- (void)showLoadingView:(NSString *)loadingMessage;
- (void)hideLoadingView;

- (void)checkNetworkStatus:(NSNotification *)notice;

@end
