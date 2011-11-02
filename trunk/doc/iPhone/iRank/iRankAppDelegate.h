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
    LoginViewController *loginViewController;
    NSUserDefaults *userDefaults;
}

@property (nonatomic, retain) IBOutlet UIWindow *window;
@property (nonatomic, retain) IBOutlet UITabBarController *tabBarController;
@property (nonatomic, retain) LoginViewController *loginViewController;
@property (nonatomic, readonly) NSUserDefaults *userDefaults;

-(void)switchLogin;
-(void)showAlert:(NSString *)title message:(NSString *)message;

@end
