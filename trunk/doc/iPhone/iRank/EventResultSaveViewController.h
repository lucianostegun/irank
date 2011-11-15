//
//  EventResultSaveViewController.h
//  iRank
//
//  Created by Luciano Stegun on 01/05/2011.
//  Copyright (c) 2011 __MyCompanyName__. All rights reserved.
//

#import <UIKit/UIKit.h>
#import "Event.h"
#import "EventPlayer.h"

@interface EventResultSaveViewController : UIViewController {
    
    IBOutlet UILabel *playerName;
    IBOutlet UILabel *playerPosition;
    IBOutlet UILabel *eventName;
    IBOutlet UILabel *eventPlaceDate;
    
    IBOutlet UITextField *buyin;
    IBOutlet UITextField *rebuy;
    IBOutlet UITextField *addon;
    IBOutlet UITextField *prize;
    
    IBOutlet UIButton *btnIncraseBuyin;
    IBOutlet UIButton *btnDecraseBuyin;
    
    IBOutlet UIBarButtonItem *btnCalculatePrize;
    
    IBOutlet UITableView *resultTableView;
    
    IBOutlet UIViewController *resultPreviewViewController;
    
    BOOL    moveViewUp;
    CGFloat scrollAmount;
    
    UIActivityIndicatorView *activityIndicator;
    UIBarButtonItem *activityIndicatorButton;
    
    int currentPosition;
    
    UIBarButtonItem *doneButton;
    UIBarButtonItem *saveButton;
}

@property (nonatomic, assign) Event *event;
@property (nonatomic, assign) EventPlayer *eventPlayer;
@property (nonatomic, retain) NSNumberFormatter *numberFormatter;

-(void)loadPlayerInfo:(int)playerPositionIndex;
-(IBAction)loadNextPlayerInfo:(id)sender;
-(IBAction)loadPreviousPlayerInfo:(id)sender;
-(IBAction)incraseBuyinValue:(id)sender;
-(IBAction)decraseBuyinValue:(id)sender;
-(IBAction)incraseRebuyValue:(id)sender;
-(IBAction)decraseRebuyValue:(id)sender;
-(IBAction)incraseAddonValue:(id)sender;
-(IBAction)decraseAddonValue:(id)sender;
-(IBAction)calculatePrize:(id)sender;

- (void)scrollTheView: (BOOL)movedUp;
- (void)concludeSaveResult;

@end
