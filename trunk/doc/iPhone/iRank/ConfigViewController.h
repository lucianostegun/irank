//
//  ConfigViewController.h
//  iRank
//
//  Created by Luciano Stegun on 01/05/2011.
//  Copyright (c) 2011 __MyCompanyName__. All rights reserved.
//

#import <UIKit/UIKit.h>

@interface ConfigViewController : UIViewController {
    
    IBOutlet UISegmentedControl *homeEventsSegmendetControl;
}

-(IBAction)didSelectEventCount:(id)sender;

@end
