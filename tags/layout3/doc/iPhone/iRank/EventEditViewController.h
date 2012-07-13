//
//  EventEditViewController.h
//  iRank
//
//  Created by Luciano Stegun on 01/05/2012.
//  Copyright (c) 2012 __MyCompanyName__. All rights reserved.
//

#import <UIKit/UIKit.h>
#import "ELCTextfieldCell.h"
#import "iRankAppDelegate.h"

@interface EventEditViewController : UITableViewController <UIPickerViewDelegate, UIPickerViewDataSource> {
        
    iRankAppDelegate *appDelegate;
}

@property (nonatomic, retain) NSArray *labels;
@property (nonatomic, retain) NSArray *placeholders;

@property(nonatomic , retain) IBOutlet UIPickerView *rankingPicker;
@property(nonatomic , retain) NSArray *rankingPickerData;

- (void)configureCell:(ELCTextfieldCell *)cell atIndexPath:(NSIndexPath *)indexPath;

- (void)showRankingPicker;

@end
