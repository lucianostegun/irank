//
//  HomeViewController.h
//  iRank
//
//  Created by Luciano Stegun on 01/05/2011.
//  Copyright 2011 __MyCompanyName__. All rights reserved.
//

#import <UIKit/UIKit.h>
#import "EventDetailViewController.h"

@interface HomeViewController : UITableViewController <UITableViewDataSource, UITableViewDelegate> {
    
    IBOutlet UIBarButtonItem *quitButton;
    IBOutlet UIView *loadingView;
    iRankAppDelegate *appDelegate;
}

@property (nonatomic, retain) NSMutableArray *bankrollInfo;
@property (nonatomic, retain) NSMutableArray *nextEventList;
@property (nonatomic, retain) NSMutableArray *previousEventList;
@property (nonatomic, retain) EventDetailViewController *eventDetailViewController;

- (IBAction)doLogout:(id)sender;
- (void)reloadData;
- (void)updateEventList;
- (void)updateResume;

@end
