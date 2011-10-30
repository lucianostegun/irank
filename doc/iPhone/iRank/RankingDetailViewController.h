//
//  RankingDetailViewController.h
//  iRank
//
//  Created by Luciano Stegun on 01/05/2011.
//  Copyright 2011 __MyCompanyName__. All rights reserved.
//

#import <UIKit/UIKit.h>
#import "Ranking.h"

@interface RankingDetailViewController : UITableViewController {
    
    Ranking *ranking;
    IBOutlet UIDatePicker *datePicker;
//    IBOutlet UIBarButtonItem *doneButton;
}

@property (nonatomic, assign) Ranking *ranking;
@property (nonatomic, copy) UIDatePicker *datePicker;

@end
