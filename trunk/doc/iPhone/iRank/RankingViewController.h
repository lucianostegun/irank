//
//  RankingViewController.h
//  iRank
//
//  Created by Luciano Stegun on 01/05/2011.
//  Copyright 2011 __MyCompanyName__. All rights reserved.
//

#import <UIKit/UIKit.h>
#import "iRankAppDelegate.h"
#import "RankingDetailViewController.h"

@interface RankingViewController : UIViewController {
    
    iRankAppDelegate *appDelegate;
    NSString *userSiteId;
    RankingDetailViewController *detailViewController;
    IBOutlet UIDatePicker *datePicker;
    IBOutlet UITableView *tableView;
}

@property (nonatomic, retain) iRankAppDelegate *appDelegate;
@property (nonatomic, retain) RankingDetailViewController *detailViewController;
@property (nonatomic, retain) UIDatePicker *datePicker;
@property (nonatomic, retain) NSString *userSiteId;
@property (nonatomic, retain) IBOutlet UITableView *tableView;

-(IBAction)teste;

@end
