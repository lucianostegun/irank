//
//  ConfigViewController.h
//  iRank
//
//  Created by Luciano Stegun on 01/05/2011.
//  Copyright (c) 2011 __MyCompanyName__. All rights reserved.
//

#import <UIKit/UIKit.h>
#import "iRankAppDelegate.h"

@interface ConfigViewController : UIViewController {
    
    IBOutlet UISegmentedControl *homeEventsSegmendetControl;
    IBOutlet UISwitch *saveResultOfflineSwitch;
    iRankAppDelegate *appDelegate;
}

-(IBAction)didSelectEventCount:(id)sender;
-(IBAction)changeSaveResultOffline:(id)sender;

@end
