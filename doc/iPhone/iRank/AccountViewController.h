//
//  AccountViewController.h
//  iRank
//
//  Created by Luciano Stegun on 01/05/2011.
//  Copyright (c) 2011 __MyCompanyName__. All rights reserved.
//

#import <UIKit/UIKit.h>
#import "ELCTextfieldCell.h"

@interface AccountViewController : UITableViewController <ELCTextFieldDelegate> {
    
    NSString *username;
    NSString *emailAddress;
    NSString *firstName;
    NSString *lastName;
    NSString *password;
    NSString *passwordConfirm;
}

@property (nonatomic, retain) NSArray *labels;
@property (nonatomic, retain) NSArray *placeholders;
@property (nonatomic, retain) NSArray *defaultValues;

@end
