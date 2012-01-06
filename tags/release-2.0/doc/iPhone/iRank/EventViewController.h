//
//  EventViewController.h
//  iRank
//
//  Created by Luciano Stegun on 01/05/2011.
//  Copyright (c) 2011 __MyCompanyName__. All rights reserved.
//

#import <UIKit/UIKit.h>
#import "EventDetailViewController.h"
#import "iRankAppDelegate.h"

@interface EventViewController : UITableViewController {
    
    iRankAppDelegate *appDelegate;
    EventDetailViewController *eventDetailViewController;
}

@property (nonatomic, retain) NSMutableArray *eventList;
@property (nonatomic, readwrite) int rankingId;

- (id)initWithStyle:(UITableViewStyle)style rankingId:(int)theRankingId;
- (void)updateEventList;

@end
