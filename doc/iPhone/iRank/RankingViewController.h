//
//  RankingViewController.h
//  iRank
//
//  Created by Luciano Stegun on 01/05/2011.
//  Copyright 2011 __MyCompanyName__. All rights reserved.
//

#import <UIKit/UIKit.h>
#import "iRankAppDelegate.h"

@interface RankingViewController : UIViewController {
    
    iRankAppDelegate *appDelegate;
    IBOutlet UIViewController *detailViewController;
}

@property (nonatomic, retain) iRankAppDelegate *appDelegate;
@property (nonatomic, retain) IBOutlet UIViewController *detailViewController;

@end
