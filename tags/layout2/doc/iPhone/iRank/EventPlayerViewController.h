//
//  EventPlayerViewController.h
//  iRank
//
//  Created by Luciano Stegun on 01/05/2011.
//  Copyright (c) 2011 __MyCompanyName__. All rights reserved.
//

#import <UIKit/UIKit.h>
#import "Event.h"
#import "iRankAppDelegate.h"

@interface EventPlayerViewController : UITableViewController{
    
    UIBarButtonItem *doneButton;
    UIBarButtonItem *addButton;
    iRankAppDelegate *appDelegate;
    NSMutableArray *eventPlayerList;
}

@property (nonatomic, assign) Event *event;
@property (nonatomic, readwrite) BOOL showEnabledOnly;

- (void)configureView;
- (void)updatePlayerList;
//-(void)doUpdatePlayerListAndReloadData;

- (void)handlePlayerList:(NSNotification *)notice;

@end
