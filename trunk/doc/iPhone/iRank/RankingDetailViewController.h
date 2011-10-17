//
//  RankingDetailViewController.h
//  iRank
//
//  Created by Luciano Stegun on 01/05/2011.
//  Copyright 2011 __MyCompanyName__. All rights reserved.
//

#import <UIKit/UIKit.h>
#import "Ranking.h"

@interface RankingDetailViewController : UIViewController {
    
    Ranking *ranking;
    IBOutlet UITableView *mainTableView;
}

@property (nonatomic, retain) Ranking *ranking;
@property (nonatomic, retain) IBOutlet UITableView *mainTableView;

@end
