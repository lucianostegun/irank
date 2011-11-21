//
//  iRankAppDelegate.h
//  iRank
//
//  Created by Luciano Stegun on 01/05/2011.
//  Copyright 2011 __MyCompanyName__. All rights reserved.
//

#import <UIKit/UIKit.h>
#import "LoginViewController.h"

@interface iRankAppDelegate : NSObject <UIApplicationDelegate> {
    
    IBOutlet UITabBarController *tabBarController;
    IBOutlet UITabBarItem *homeTabBar;
    LoginViewController *loginViewController;
    NSUserDefaults *userDefaults;
    NSInteger mainBadge;
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

-(void)switchLogin;
-(void)showLogin;
-(void)showAlert:(NSString *)title message:(NSString *)message;
-(void)incraseBadge:(int)amount;
-(void)decraseBadge:(int)amount;
-(void)updateBadge;
-(void)putOnLandscapeMode;

@end
