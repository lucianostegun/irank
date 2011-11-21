//
//  PhotoViewController.h
//  iRank
//
//  Created by Luciano Stegun on 01/05/2011.
//  Copyright (c) 2011 __MyCompanyName__. All rights reserved.
//

#import <UIKit/UIKit.h>

@interface PhotoViewController : UIViewController {
    
    UIActivityIndicatorView *activityIndicator;
    IBOutlet UIWebView *webView;
}

@property (nonatomic, assign) IBOutlet UIWebView *webView;
@property (nonatomic, readwrite) int eventId;
@property (nonatomic, readwrite) int lastEventId;

- (void)doRefreshWebView:(BOOL)fullRefresh;

@end