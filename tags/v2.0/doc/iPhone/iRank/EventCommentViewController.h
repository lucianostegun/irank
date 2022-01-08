//
//  EventCommentViewController.h
//  iRank
//
//  Created by Luciano Stegun on 01/05/2011.
//  Copyright (c) 2011 __MyCompanyName__. All rights reserved.
//

#import <UIKit/UIKit.h>

@interface EventCommentViewController : UIViewController <UIWebViewDelegate> {
    
    IBOutlet UIToolbar *toolbar;
    IBOutlet UITextField *txtMessage;
    IBOutlet UIBarButtonItem *btnSend;
    CGFloat  scrollAmount;
    BOOL     moveViewUp;
    UIActivityIndicatorView *activityIndicator;
}

@property (nonatomic, assign) IBOutlet UIWebView *webView;
@property (nonatomic, readwrite) int eventId;
@property (nonatomic, readwrite) int lastEventId;

- (void)scrollTheView: (BOOL)movedUp;
- (void)doRefreshWebView:(BOOL)fullRefresh;
- (IBAction)sendMessage:(id)sender;

@end
