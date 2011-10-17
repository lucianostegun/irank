//
//  EventViewController.h
//  iRank
//
//  Created by Luciano Stegun on 01/05/2011.
//  Copyright 2011 __MyCompanyName__. All rights reserved.
//

#import <UIKit/UIKit.h>
#import "iRankAppDelegate.h"

@interface EventViewController : UIViewController {
    
    iRankAppDelegate *appDelegate;
    NSString *userSiteId;
    IBOutlet UIViewController *detailViewController;
}

@property (nonatomic, retain) iRankAppDelegate *appDelegate;
@property (nonatomic, retain) IBOutlet UIViewController *detailViewController;
@property (nonatomic, retain) NSString *userSiteId;

@end
