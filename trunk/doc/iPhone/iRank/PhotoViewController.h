//
//  PhotoViewController.h
//  iRank
//
//  Created by Luciano Stegun on 01/05/2011.
//  Copyright (c) 2011 __MyCompanyName__. All rights reserved.
//

#import <UIKit/UIKit.h>

@interface PhotoViewController : UIViewController <UINavigationControllerDelegate, UIImagePickerControllerDelegate> {
    
    UIActivityIndicatorView *activityIndicator;
    NSMutableArray *buttonImageList;
    NSMutableArray *eventPhotoList;

    BOOL isZoom;
    BOOL refreshesImageList;

    IBOutlet UILabel *lblNoPhoto;
    IBOutlet UIBarButtonItem *btnCamera;
}

@property (nonatomic, assign) IBOutlet UIWebView *webView;
@property (nonatomic, readwrite) int eventId;
@property (nonatomic, readwrite) int lastEventId;

- (void)doRefreshWebView:(BOOL)fullRefresh;
- (void)updateImageList;
- (void)drawImages;
- (void)selectImage:(id)sender;
- (void)showAllImages;
- (void)centerZoomImage;
- (void)addImage:(UIImage *)image tag:(int)tag;
- (IBAction)takePicture:(id)sender;
@end