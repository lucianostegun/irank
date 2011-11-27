//
//  SignViewController.h
//  iRank
//
//  Created by Luciano Stegun on 01/05/2011.
//  Copyright (c) 2011 __MyCompanyName__. All rights reserved.
//

#import <UIKit/UIKit.h>
#import "ELCTextfieldCell.h"

@interface SignViewController : UITableViewController <ELCTextFieldDelegate> {

    NSString *emailAddress;
    NSString *firstName;
    NSString *lastName;
    NSString *passwordConfirm;
}


@property (nonatomic, retain) NSString *username;
@property (nonatomic, retain) NSString *password;
@property (nonatomic, retain) NSArray *labels;
@property (nonatomic, retain) NSArray *placeholders;
@property (nonatomic, retain) NSArray *tempValues;
@property (nonatomic, readonly) BOOL signSuccess;

- (void)configureCell:(UITableViewCell *)cell atIndexPath:(NSIndexPath *)indexPath;
- (void)saveSign:(id)sender;
- (void)populateField:(id)sender;

@end
