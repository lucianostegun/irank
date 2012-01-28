//
//  ConfigViewController.h
//  iRank
//
//  Created by Luciano Stegun on 01/05/2011.
//  Copyright (c) 2011 __MyCompanyName__. All rights reserved.
//

#import <UIKit/UIKit.h>
#import "iRankAppDelegate.h"
#import "AccountViewController.h"

@interface ConfigViewController : UIViewController {
    
    IBOutlet UISegmentedControl *homeEventsSegmendetControl;
    IBOutlet UISwitch *saveResultOfflineSwitch;
    IBOutlet UISlider *photoCompressSlider;
    IBOutlet UILabel *lblPhotoCompress;
    
    IBOutlet UILabel *lblHomeEvents;
    IBOutlet UILabel *lblSaveOffline;
    IBOutlet UITextView *lblSaveOfflineInfo;
    IBOutlet UILabel *lblCompressPhoto;    
    
    iRankAppDelegate *appDelegate;
    AccountViewController *accountViewController;
}

-(void)accountButtonTouchUp:(id)sender;

-(IBAction)didSelectEventCount:(id)sender;
-(IBAction)changeSaveResultOffline:(id)sender;
-(IBAction)changePhotoCompress:(id)sender;

@end
