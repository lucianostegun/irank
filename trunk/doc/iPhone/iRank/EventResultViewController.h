//
//  EventResultViewController.h
//  iRank
//
//  Created by Luciano Stegun on 01/05/2011.
//  Copyright (c) 2011 __MyCompanyName__. All rights reserved.
//

#import <UIKit/UIKit.h>
#import "Event.h"

@interface EventResultViewController : UIViewController <UITableViewDelegate, UITableViewDataSource> {
    
    NSNumberFormatter *numberFormatter;
    IBOutlet UILabel *playerName;
    IBOutlet UILabel *eventPlaceDate;
    IBOutlet UILabel *position;
    IBOutlet UILabel *buyin;
    IBOutlet UILabel *rebuy;
    IBOutlet UILabel *addon;
    IBOutlet UILabel *prize;
    IBOutlet UILabel *score;
    
    IBOutlet UIViewController *resultDetailViewController;
}

@property (nonatomic, assign) Event *event;
//@property (nonatomic, retain) IBOutlet UIViewController *resultDetailViewController;

@end
