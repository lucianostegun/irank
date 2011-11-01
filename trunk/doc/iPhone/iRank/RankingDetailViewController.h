//
//  RankingDetailViewController.h
//  iRank
//
//  Created by Luciano Stegun on 01/05/2011.
//  Copyright 2011 __MyCompanyName__. All rights reserved.
//

#import <UIKit/UIKit.h>
#import "Ranking.h"

@interface RankingDetailViewController : UITableViewController <UIPickerViewDelegate, UIPickerViewDataSource> {
    
    Ranking *ranking;
    IBOutlet UIDatePicker *datePicker;
    IBOutlet UIPickerView *pickerView;
    NSMutableArray *pickerOptionList;
    IBOutlet UIBarButtonItem *saveButton;
}

@property (nonatomic, assign) Ranking *ranking;
@property (nonatomic, retain) UIPickerView *pickerView;
@property (nonatomic, retain) NSMutableArray *pickerOptionList;
@property (nonatomic, retain) IBOutlet UIBarButtonItem *saveButton;

- (void)dismissDatePicker:(id)sender;
- (void)dismissPickerView:(id)sender;
- (void)showDatePicker:(NSIndexPath *)indexPath;
- (void)showPickerView:(NSIndexPath *)indexPath;
- (IBAction)saveRanking:(id)sender;

-(void)teste;

@end
