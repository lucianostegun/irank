//
//  HomeViewController.h
//  iRank
//
//  Created by Luciano Stegun on 01/05/2011.
//  Copyright 2011 __MyCompanyName__. All rights reserved.
//

#import <UIKit/UIKit.h>

@interface HomeViewController : UITableViewController <UITableViewDataSource, UITableViewDelegate> {
    
    IBOutlet UIBarButtonItem *quitButton;
    NSMutableArray *bankrollInfo;
}

@property (nonatomic, retain) NSMutableArray *bankrollInfo;

-(IBAction)doLogout:(id)sender;
@end
