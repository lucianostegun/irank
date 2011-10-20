//
//  PhotoViewController.h
//  iRank
//
//  Created by Luciano Stegun on 01/05/2011.
//  Copyright 2011 __MyCompanyName__. All rights reserved.
//

#import <UIKit/UIKit.h>

@interface PhotoViewController : UITableViewController {
    
    IBOutlet UIDatePicker *datePicker;
    IBOutlet UIPickerView *pickerView;
    IBOutlet UIView *mainView;
}

@property (nonatomic, retain) IBOutlet UIDatePicker *datePicker;
@property (nonatomic, retain) IBOutlet UIPickerView *pickerView;
@property (nonatomic, retain) IBOutlet UIView *mainView;
@end
