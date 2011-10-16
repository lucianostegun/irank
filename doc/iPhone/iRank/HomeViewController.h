//
//  HomeViewController.h
//  iRank
//
//  Created by Luciano Stegun on 01/05/2011.
//  Copyright 2011 __MyCompanyName__. All rights reserved.
//

#import <UIKit/UIKit.h>

#import "iRankAppDelegate.h"
#import "LoginController.h"

@interface HomeViewController : UIViewController {
    
    
    IBOutlet UITableView *tableView;
    IBOutlet UIActivityIndicatorView *updateIndicator;
    IBOutlet UIBarButtonItem *updateButton;
    
    NSMutableArray *bankrollMenuList;
    NSString *fee;
    NSString *buyin;
    NSString *addon;
    NSString *rebuy;
    NSString *prize;
    NSString *score;
    NSString *balance;
    NSURLConnection *connection;
    
    iRankAppDelegate *appDelegate;
    LoginController *loginController;
    
}

@property (nonatomic, retain) NSURLConnection * connection;
@property (nonatomic, retain) NSMutableArray *bankrollMenuList;
@property (nonatomic, retain) UITableView *tableView;
@property (nonatomic, retain) UIActivityIndicatorView *updateIndicator;
@property (nonatomic, retain) NSString *fee;
@property (nonatomic, retain) NSString *buyin;
@property (nonatomic, retain) NSString *addon;
@property (nonatomic, retain) NSString *rebuy;
@property (nonatomic, retain) NSString *prize;
@property (nonatomic, retain) NSString *score;
@property (nonatomic, retain) NSString *balance;
@property (nonatomic, retain) UIBarButtonItem *updateButton;

@property (nonatomic, retain) iRankAppDelegate *appDelegate;
@property (nonatomic, retain) LoginController *loginController;

- (IBAction)doLogout:(id)sender;
- (IBAction)updateData:(id)sender;

@end
