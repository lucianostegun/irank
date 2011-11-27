//
//  EventPlayerViewController.h
//  iRank
//
//  Created by Luciano Stegun on 01/05/2011.
//  Copyright (c) 2011 __MyCompanyName__. All rights reserved.
//

#import <UIKit/UIKit.h>
#import "Event.h"

@interface EventPlayerViewController : UITableViewController{
    
    UIBarButtonItem *doneButton;
}

@property (nonatomic, assign) Event *event;
@property (nonatomic, readwrite) BOOL showEnabledOnly;

-(void)doUpdatePlayerList:(BOOL)reloadData;
-(void)doUpdatePlayerListAndReloadData;

@end
