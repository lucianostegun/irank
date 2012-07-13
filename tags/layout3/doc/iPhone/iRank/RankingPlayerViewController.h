//
//  RankingPlayerViewController.h
//  iRank
//
//  Created by Luciano Stegun on 01/05/2011.
//  Copyright (c) 2011 __MyCompanyName__. All rights reserved.
//

#import <UIKit/UIKit.h>
#import "iRankAppDelegate.h"
#import "Ranking.h"

@interface RankingPlayerViewController : UITableViewController {
    
    iRankAppDelegate *appDelegate;
    UIBarButtonItem *addButton;
}

@property (nonatomic, retain) NSMutableArray *rankingPlayerList;
@property (nonatomic, assign) Ranking *ranking;
@property (nonatomic, readwrite) BOOL sortByPosition;

- (void)updateRankingPlayerList;

@end
