//
//  LoginViewController.h
//  iRank
//
//  Created by Luciano Stegun on 01/05/2011.
//  Copyright 2011 __MyCompanyName__. All rights reserved.
//

#import <UIKit/UIKit.h>
#import "SignViewController.h"

@interface LoginViewController : UIViewController {
    
    IBOutlet UITextField *txtUsername;
    IBOutlet UITextField *txtPassword;
    IBOutlet UIActivityIndicatorView *activityIndicator;
    IBOutlet UIButton *infoButton;
    IBOutlet UIView *infoView;
    SignViewController *signViewController;
}

@property (nonatomic, retain) IBOutlet UITextField *txtUsername;
@property (nonatomic, retain) IBOutlet UITextField *txtPassword;
@property (nonatomic, retain) IBOutlet UIActivityIndicatorView *activityIndicator;

-(IBAction)doLogin:(id)sender;
-(IBAction)showInfoView:(id)sender;
-(IBAction)hideInfoView:(id)sender;
-(IBAction)showSignView:(id)sender;
-(IBAction)switchLogin;


@end
