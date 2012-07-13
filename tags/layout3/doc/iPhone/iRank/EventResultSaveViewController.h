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
#import "iRankAppDelegate.h"

@interface EventResultSaveViewController : UIViewController {
    
    iRankAppDelegate *appDelegate;
    
    IBOutlet UILabel *playerName;
    IBOutlet UILabel *playerPosition;
    IBOutlet UILabel *eventName;
    IBOutlet UILabel *eventPlaceDate;
    IBOutlet UILabel *lblBuyin;
    IBOutlet UILabel *lblRebuy;
    IBOutlet UILabel *lblAddon;
    IBOutlet UILabel *lblPrize;
    IBOutlet UITextView *lblPrizeInfo;
    
    IBOutlet UITextField *buyin;
    IBOutlet UITextField *rebuy;
    IBOutlet UITextField *addon;
    IBOutlet UITextField *prize;
    
    IBOutlet UIButton *btnIncraseBuyin;
    IBOutlet UIButton *btnDecraseBuyin;
    IBOutlet UIButton *btnIncraseRebuy;
    IBOutlet UIButton *btnDecraseRebuy;
    IBOutlet UIButton *btnIncraseAddon;
    IBOutlet UIButton *btnDecraseAddon;
    
    IBOutlet UIBarButtonItem *btnPrevious;
    IBOutlet UIBarButtonItem *btnNext;
    
    IBOutlet UIBarButtonItem *btnCalculatePrize;
    
    IBOutlet UITextView *ringInfo;
    
    IBOutlet UIToolbar *prizeToolbar;
    
    IBOutlet UISegmentedControl *segmentedControl;
    
    IBOutlet UITableView *resultTableView;
    
    BOOL    viewResumeMode;
    BOOL    moveViewUp;
    CGFloat scrollAmount;
    
    UIActivityIndicatorView *activityIndicator;
    UIBarButtonItem *activityIndicatorButton;
    
    int currentPosition;
    
    UIBarButtonItem *doneButton;
    UIBarButtonItem *saveButton;
    
    NSMutableArray *eventPlayerBuyinList;
    NSMutableArray *eventPlayerRebuyList;
    NSMutableArray *eventPlayerAddonList;
    
    IBOutlet UIViewController *resultPreviewViewController;
}

@property (nonatomic, assign) Event *event;
@property (nonatomic, assign) EventPlayer *eventPlayer;
@property (nonatomic, retain) NSNumberFormatter *numberFormatter;
@property (nonatomic, assign) NSMutableArray *eventPlayerList;
@property (nonatomic, assign) UITextField *theTextField;

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
-(IBAction)updateCurrentTextField:(id)sender;
-(IBAction)segmentedControlTouchUp:(id)sender;

- (void)configureResultViewController;
- (void)scrollTheView: (BOOL)movedUp;
- (void)concludeSaveResult;
- (void)concludeSaveResultWithError;
- (void)concludeCalculatePrize;
- (void)doSaveEventResult;
- (void)doneButtonTouchUp:(id)sender;
- (UIViewController *)resultPreviewViewController;

@end
