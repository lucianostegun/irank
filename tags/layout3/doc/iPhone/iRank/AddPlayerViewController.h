//
//  AddPlayerViewController.h
//  iRank
//
//  Created by Luciano Stegun on 01/05/2011.
//  Copyright (c) 2011 __MyCompanyName__. All rights reserved.
//

#import <UIKit/UIKit.h>
#import "ELCTextfieldCell.h"
#import "iRankAppDelegate.h"

@interface AddPlayerViewController : UITableViewController {
    
    NSString *firstName;
    NSString *lastName;
    NSString *emailAddress;
    iRankAppDelegate *appDelegate;
}

@property (nonatomic, readwrite) int rankingId;
@property (nonatomic, readwrite) int eventId;
@property (nonatomic, retain) NSArray *labels;
@property (nonatomic, retain) NSArray *placeholders;

-(void)savePlayer:(id)sender;
-(void)doSavePlayer;

@end
