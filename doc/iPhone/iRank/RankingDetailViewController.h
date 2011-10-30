//
//  RankingDetailViewController.h
//  iRank
//
//  Created by Luciano Stegun on 01/05/2011.
//  Copyright 2011 __MyCompanyName__. All rights reserved.
//

#import <UIKit/UIKit.h>
#import "Ranking.h"
#import "ELCTextfieldCell.h"

@interface RankingDetailViewController : UITableViewController <ELCTextFieldDelegate, UIPickerViewDelegate, UIPickerViewDataSource>  {
    
    Ranking *ranking;
    UIDatePicker *datePicker;
    IBOutlet UIPickerView *pickerView;
    NSMutableArray *pickerOptionList;
	UIBarButtonItem *doneButton;
}

@property (nonatomic, retain) Ranking *ranking;
@property (nonatomic, retain) IBOutlet UIDatePicker *datePicker;
@property (nonatomic, retain) IBOutlet UIPickerView *pickerView;
@property (nonatomic, retain) NSMutableArray *pickerOptionList;
@property (nonatomic, retain) IBOutlet UIBarButtonItem *doneButton;

- (void)textFieldTouchUp:(id)selector;
- (void)showPickerView: (NSInteger)row cellValue:(NSString *)cellValue;
- (void)doneAction;

@end