//
//  iRankAppDelegate.h
//  iRank
//
//  Created by Luciano Stegun on 01/05/2011.
//  Copyright 2011 __MyCompanyName__. All rights reserved.
//

#import <UIKit/UIKit.h>

@interface iRankAppDelegate : NSObject <UIApplicationDelegate, UITabBarControllerDelegate> {
    
    NSUserDefaults *defaults;
    NSMutableArray *rankingList;
    NSMutableArray *eventList;
    NSString *userSiteId;
}

@property (nonatomic, retain) IBOutlet UIWindow *window;
@property (nonatomic, retain) IBOutlet UITabBarController *tabBarController;

@property (nonatomic, retain) NSUserDefaults *defaults;
@property (nonatomic, retain) NSMutableArray *rankingList;
@property (nonatomic, retain) NSMutableArray *eventList;
@property (nonatomic, retain) NSString *userSiteId;

@end
