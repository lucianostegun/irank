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
#import "EventResultViewController.h"
#import "PhotoViewController.h"

@interface EventDetailViewController : UITableViewController {
    
    UIView *headerView;
    UIActivityIndicatorView *activityIndicator;
    EventCommentViewController *eventCommentViewController;
    EventPlayerViewController *eventPlayerViewController;
    EventResultViewController *eventResultViewController;
    PhotoViewController *photoViewController;
    UISegmentedControl *segmentedControl;
}

@property (nonatomic, assign) Event *event;

-(UIView *)headerView;

@end
