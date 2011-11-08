//
//  EventDetailViewController.h
//  iRank
//
//  Created by Luciano Stegun on 01/05/2011.
//  Copyright (c) 2011 __MyCompanyName__. All rights reserved.
//

#import <UIKit/UIKit.h>
#import "Event.h"
#import "EventPlayerViewController.h"
#import "EventCommentViewController.h"

@interface EventDetailViewController : UITableViewController {
    
    UIView *headerView;
    UIActivityIndicatorView *activityIndicator;
    EventCommentViewController *eventCommentViewController;
    EventPlayerViewController *eventPlayerViewController;
}

@property (nonatomic, assign) Event *event;
//@property (nonatomic, retain) EventPlayerViewController *eventPlayerViewController;
//@property (nonatomic, retain) EventCommentViewController *eventCommentViewController;

-(UIView *)headerView;

@end
