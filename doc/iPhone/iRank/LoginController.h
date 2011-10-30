//
//  LoginController.h
//  iRank
//
//  Created by Luciano Stegun on 01/05/2011.
//  Copyright 2011 __MyCompanyName__. All rights reserved.
//

#import <UIKit/UIKit.h>
@class iRankAppDelegate;

@interface LoginController : UIViewController <UITextFieldDelegate, UITableViewDelegate> {
    
    IBOutlet UIButton *signButton;
    IBOutlet UIView *signView;
    IBOutlet UITextField *txtUsername;
    IBOutlet UITextField *txtPassword;
    IBOutlet UIActivityIndicatorView *activityIndicator;
    iRankAppDelegate *appDelegate;
}

@property (nonatomic, retain) IBOutlet UIView *signView;
@property (nonatomic, retain) IBOutlet UIButton *signButton;
@property (nonatomic, retain) IBOutlet UITextField *txtUsername;
@property (nonatomic, retain) IBOutlet UITextField *txtPassword;
@property (nonatomic, retain) IBOutlet UIActivityIndicatorView *activityIndicator;


- (IBAction)signButtonTouchUp:(id)sender;
//- (IBAction)signCancelButtonTouchUp:(id)sender;
- (NSString *)getMD5FromString:(NSString *)source;
- (void)handleLoginResult:(NSString *)data;

@end
