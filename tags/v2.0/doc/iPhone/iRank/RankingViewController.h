//
//  RankingViewController.h
//  iRank
//
//  Created by Luciano Stegun on 01/05/2011.
//  Copyright (c) 2011 __MyCompanyName__. All rights reserved.
//

#import <UIKit/UIKit.h>
#import "iRankAppDelegate.h"
#import "RankingDetailViewController.h"

@interface RankingViewController : UITableViewController {
    
    iRankAppDelegate *appDelegate;
    RankingDetailViewController *rankingDetailViewController;
}

@property (nonatomic, retain) NSMutableArray *rankingList;

- (void)updateRankingList;

@end
