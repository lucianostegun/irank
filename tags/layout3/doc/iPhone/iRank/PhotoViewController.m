//
//  PhotoViewController.m
//  iRank
//
//  Created by Luciano Stegun on 01/05/2011.
//  Copyright (c) 2011 __MyCompanyName__. All rights reserved.
//

#import "PhotoViewController.h"
#import "iRankAppDelegate.h"
#import "XMLEventPhotoParser.h"
#import "QuartzCore/QuartzCore.h" // for CALayer
#import "EventPhoto.h"
#import "ImageCache.h"
#import "Reachability.h"

@implementation PhotoViewController
@synthesize webView;
@synthesize eventId, lastEventId;

- (id)initWithNibName:(NSString *)nibNameOrNil bundle:(NSBundle *)nibBundleOrNil
{
    self = [super initWithNibName:nibNameOrNil bundle:nibBundleOrNil];
    if (self) {

    }
    
    return self;
}

- (void)didReceiveMemoryWarning
{
    // Releases the view if it doesn't have a superview.
    [super didReceiveMemoryWarning];
    
    // Release any cached data, images, etc that aren't in use.
}

#pragma mark - View lifecycle

-(void)viewWillAppear:(BOOL)animated {
    
    [self setTitle:NSLocalizedString(@"Photos", @"photo")];
    
    if( eventId!=lastEventId ){
        
        lastEventId = eventId;
    }
    
    isZoom = NO;
    lblNoPhoto.hidden = YES;
    
    eventPhotoCacheList = [NSKeyedUnarchiver unarchiveObjectWithFile:[self photoListPath]];
    
    [eventPhotoCacheList retain];
    
    if( !eventPhotoCacheList )
        eventPhotoCacheList = [[NSMutableArray alloc] init];

    NSLog(@"eventPhotoCacheList: %@", eventPhotoCacheList);
}

-(void)updateImageList {
    
    NSURL *url = [[NSURL alloc] initWithString:[NSString stringWithFormat:@"http://%@/ios.php/event/getXml/model/eventPhoto/eventId/%i", serverAddress, eventId]];
    
    XMLEventPhotoParser *eventPhotoParser = [[XMLEventPhotoParser alloc] initXMLParser];
	
	NSURLRequest *eventPhotoRequest = [NSURLRequest requestWithURL:url cachePolicy: NSURLRequestReloadIgnoringCacheData timeoutInterval:30];
	NSError *requestError = nil;
	NSData *response = [NSURLConnection sendSynchronousRequest:eventPhotoRequest returningResponse:nil error:&requestError]; 
    BOOL success;
    
    if(requestError == nil) {
        
		NSXMLParser *parser = [[NSXMLParser alloc] initWithData:response];
        
		[parser setDelegate:eventPhotoParser];
		[parser setShouldProcessNamespaces:YES];
		[parser setShouldReportNamespacePrefixes:YES];
		[parser setShouldResolveExternalEntities:NO];
		success = [parser parse];
		[parser release];
        
        eventPhotoList = [[eventPhotoParser getEventPhotoList] copy];
        
        [eventPhotoParser release];
        
        buttonImageList = [[NSMutableArray alloc] init];
        
        int lastKey = 0;
        
        for (EventPhoto *eventPhoto in eventPhotoList) {
            
            NSURL *imageURL = [NSURL URLWithString:eventPhoto.thumbUrl];
            NSData *imageData = [NSData dataWithContentsOfURL:imageURL];
            UIImage *image = [UIImage imageWithData:imageData];
            
            [self addImage:image tag:eventPhoto.eventPhotoId];

            if( eventPhoto.eventPhotoId > lastKey )
               lastKey = eventPhoto.eventPhotoId;
            
//            [image release];
//            [imageData release];
//            [imageURL release];
        }

        for (NSString *imageKey in eventPhotoCacheList) {
            
            UIImage *image = [[ImageCache sharedImageCache] imageForKey:imageKey];
            
            [self addImage:image tag:(++lastKey)*-1];
        }
         
        if( lastKey > 0 )
            [self drawImages];
        else
            lblNoPhoto.hidden = NO;
        
	} else {
        
        NSLog(@"Timeout ao processar o XML de fotos de eventos");
	}
}

-(void)addImage:(UIImage *)image tag:(int)tag{
    
    UIButton *buttonImage = [[UIButton alloc] init];
    buttonImage.tag = tag;
    
    [buttonImage addTarget:self action:@selector(selectImage:) forControlEvents:UIControlEventTouchUpInside];
    
    [buttonImage setBackgroundImage:image forState:UIControlStateNormal];
    //[buttonImage setImage:image forState:UIControlStateNormal];
    
    CALayer * layer = [buttonImage layer];
    [layer setMasksToBounds:YES];
    [layer setCornerRadius:0.0];
    [layer setBorderWidth:1.0];
    [layer setBorderColor:[[UIColor grayColor] CGColor]];
    
    [buttonImageList addObject:buttonImage];
    [buttonImage release];
}

-(void)showAllImages {

    for (UIButton *aButtonImage in buttonImageList) 
        aButtonImage.hidden = NO;
}

-(void)selectImage:(id)sender {

    UIButton *buttonImage = (UIButton*)sender;
    EventPhoto *eventPhoto;
    
    if( isZoom==YES ){

        [self showAllImages];
        [self drawImages];
        isZoom = NO;
        return;
    }
    
    isZoom = YES;
    
    int index = 0;
    for (UIButton *aButtonImage in buttonImageList) {
        
        if( aButtonImage.tag!=buttonImage.tag )
            aButtonImage.hidden = YES;
        else if( aButtonImage.tag > 0 ){
            
            eventPhoto = [eventPhotoList objectAtIndex:index];
        }
            

        index++;
    }
    
    buttonImage.frame = CGRectMake(10, 10, 300, 225);

    if( buttonImage.tag > 0 ){

        NSURL *imageURL = [NSURL URLWithString:eventPhoto.imageUrl];
        NSData *imageData = [NSData dataWithContentsOfURL:imageURL];
        UIImage *image = [UIImage imageWithData:imageData];
        
        [buttonImage setBackgroundImage:image forState:UIControlStateNormal];
    }
    
    [self centerZoomImage];
}

-(void)drawImages {
    
    lblNoPhoto.hidden = YES;
    
    int x = 0;
    int y = 4;
    int index = 1;
    int limit = 5;
    
    UIInterfaceOrientation interfaceOrientation = self.interfaceOrientation;
    
    if( interfaceOrientation==UIInterfaceOrientationLandscapeLeft || interfaceOrientation==UIInterfaceOrientationLandscapeRight )
        limit = 7;
    
    for (UIButton *buttonImage in buttonImageList) {
        
        x = index*79-75;
        
        buttonImage.frame = CGRectMake(x, y, 75, 56);
        
        [self.view addSubview:buttonImage];
        
        index++;
        
        if( index==limit ){
            
            x  = 0;
            y += 60;
            index = 1;
        }
    }
}

-(void)centerZoomImage {
    
    int x = 10;
    
    UIInterfaceOrientation interfaceOrientation = self.interfaceOrientation;
    
    if( interfaceOrientation==UIInterfaceOrientationLandscapeLeft || interfaceOrientation==UIInterfaceOrientationLandscapeRight )
        x = 90;
            
    for (UIButton *buttonImage in buttonImageList) {
        
        if( buttonImage.hidden==NO ){
            
            buttonImage.frame = CGRectMake(x, 10, 300, 225);
            break;
        }
    }
}

-(void)viewDidDisappear:(BOOL)animated {
    
    for (UIButton *aButtonImage in buttonImageList) 
        [aButtonImage removeFromSuperview];
    
    refreshesImageList = YES;
}

-(void)viewDidAppear:(BOOL)animated {
    
    [super viewDidAppear:animated];
    
    if( refreshesImageList )
        [self updateImageList];
    
    
    int eventPhotoCount = [eventPhotoCacheList count];
    
    if( askForUpload && appDelegate.internetActive && appDelegate.hostActive && eventPhotoCount > 0 ){
     
        NSString *plural  = (eventPhotoCount>1?@"s":@"");
        NSString *message = [NSString stringWithFormat:@"Existem %i foto%@ ainda não salva%@.\nDeseja fazer o upload da%@ foto%@ agora?", eventPhotoCount, plural, plural, plural, plural];
        ;
        UIAlertView *alert = [[UIAlertView alloc] initWithTitle:NSLocalizedString(@"Load pictures", @"photo") message:message delegate:self cancelButtonTitle:NSLocalizedString(@"No", nil) otherButtonTitles:NSLocalizedString(@"Yes", nil), nil];
        [alert show];
        [alert release];
    }
}

-(void)viewWillDisappear:(BOOL)animated {
    
    askForUpload = YES;
}

- (void)viewDidLoad
{
    [super viewDidLoad];
    
    self.navigationController.navigationBar.barStyle = UIBarStyleBlackOpaque;
    self.navigationItem.rightBarButtonItem = btnCamera;
    
    appDelegate = (iRankAppDelegate *)[[UIApplication sharedApplication] delegate];
    
    lblNoPhoto.text = NSLocalizedString(@"This event has no photos", @"photo");
    
    refreshesImageList = YES;
    askForUpload       = YES;
}

- (void)viewDidUnload
{
    [super viewDidUnload];
    // Release any retained subviews of the main view.
    // e.g. self.myOutlet = nil;
}

- (BOOL)shouldAutorotateToInterfaceOrientation:(UIInterfaceOrientation)interfaceOrientation
{
    // Return YES for supported orientations
    return YES;//(interfaceOrientation == UIInterfaceOrientationPortrait);
}

-(void)didRotateFromInterfaceOrientation:(UIInterfaceOrientation)fromInterfaceOrientation {

    if( isZoom==NO )
        [self drawImages];
    else
        [self centerZoomImage];
}

- (void)alertView:(UIAlertView *)alertView clickedButtonAtIndex:(NSInteger)buttonIndex{
    
    if (buttonIndex == 0) {
        

    }else{
        
        [appDelegate showLoadingView:NSLocalizedString(@"loading picture...", @"photo")];
        [self performSelector:@selector(uploadCachedPictures) withObject:nil afterDelay:0.1];
    }
}

-(void)takePicture:(id)sender {
    
    UIImagePickerController *imagePicker = [[UIImagePickerController alloc] init];
    
    // If our device has a camera, we want to take a picture, otherwise, we just pick from photo library
    if( [UIImagePickerController isSourceTypeAvailable:UIImagePickerControllerSourceTypeCamera] )
        [imagePicker setSourceType:UIImagePickerControllerSourceTypeCamera];
    else
        [imagePicker setSourceType:UIImagePickerControllerSourceTypePhotoLibrary];
    
    // Image picker need a delegate so we can respond to its messages
    [imagePicker setDelegate:self];
    
    // Place image picker on the screen
    [self presentModalViewController:imagePicker animated:YES];
    
    // The image picker will be retained by ItemDetailViewController
    // until it has been dimissed
    [imagePicker release];
}

-(void)imagePickerControllerDidCancel:(UIImagePickerController *)picker {

    [self showAllImages];
    [self drawImages];
    refreshesImageList = NO;
    
    [self dismissModalViewControllerAnimated:YES];
}


-(void)imagePickerController:(UIImagePickerController *)picker didFinishPickingMediaWithInfo:(NSDictionary *)info {
    
    // Get picker image from info dictionary
    theImage = [info objectForKey:UIImagePickerControllerOriginalImage];
    [theImage retain];
    
    NSLog(@"image: %@", theImage);
    
    // Take image picker off the screen
    // you must call this dismiss method
    [self dismissModalViewControllerAnimated:YES];
    [appDelegate showLoadingView:NSLocalizedString(@"loading picture...", @"photo")];
    [self performSelector:@selector(uploadPicture) withObject:nil afterDelay:0.1];
}

-(void)uploadPicture {
    
    theImage = [UIImage imageWithCGImage:theImage.CGImage scale:0.5 orientation:theImage.imageOrientation];
    
    // Create a CFUUID object - it knows how to create unique identifiers
    CFUUIDRef newUniqueID = CFUUIDCreate(kCFAllocatorDefault);
    
    // Create a string from unique identifier
    CFStringRef newUniqueIDString = CFUUIDCreateString(kCFAllocatorDefault, newUniqueID);
    NSString *imageKey = (NSString *)newUniqueIDString;
    [imageKey retain];
    
    CFRelease(newUniqueIDString);
    CFRelease(newUniqueID);
    
    [self addImage:theImage tag:([buttonImageList count] * -1)];
    [self showAllImages];
    [self drawImages];
    refreshesImageList = NO;
    
    BOOL saveOffline = (!appDelegate.wifiConnection || !appDelegate.hostActive);
    saveOffline = (saveOffline && [[appDelegate userDefaults] boolForKey:kSaveOfflineKey]);
    saveOffline = saveOffline || kForceOfflineSaving;
    
    [[ImageCache sharedImageCache] setImage:theImage forKey:imageKey];
    
    if( !saveOffline ){
        
        [self doUploadPicture:theImage];
        [[ImageCache sharedImageCache] deleteImageForKey:imageKey];
    }else{
        
        askForUpload = NO;
        [eventPhotoCacheList addObject:imageKey];
        [NSKeyedArchiver archiveRootObject:eventPhotoCacheList toFile:[self photoListPath]];
    }
    
    [appDelegate hideLoadingView];
}

- (void)uploadCachedPictures {
    
    for (NSString *imageKey in eventPhotoCacheList) {
        
        UIImage *image = [[ImageCache sharedImageCache] imageForKey:imageKey];

        BOOL success = [self doUploadPicture:image];
        
        if( success )
            [[ImageCache sharedImageCache] deleteImageForKey:imageKey];   
    }
    
    [[NSFileManager defaultManager] removeItemAtPath:[self photoListPath] error:nil];
    [appDelegate hideLoadingView];
}

- (BOOL)doUploadPicture:(UIImage *)image {
    
    int userSiteId = [appDelegate userSiteId];
    
    int width  = image.size.width;
    int height = image.size.height;
    
    float photoCompress = 100-[[appDelegate userDefaults] floatForKey:kPhotoCompressKey];
    
    width  = width*photoCompress/100;
    height = height*photoCompress/100;
    
	CGImageRef imageRef = [image CGImage];
	CGImageAlphaInfo alphaInfo = CGImageGetAlphaInfo(imageRef);
	
	//if (alphaInfo == kCGImageAlphaNone)
    alphaInfo = kCGImageAlphaNoneSkipLast;
	
	CGContextRef bitmap = CGBitmapContextCreate(NULL, width, height, CGImageGetBitsPerComponent(imageRef), 4 * width, CGImageGetColorSpace(imageRef), alphaInfo);
	CGContextDrawImage(bitmap, CGRectMake(0, 0, width, height), imageRef);
	CGImageRef ref = CGBitmapContextCreateImage(bitmap);
	UIImage *imageResult = [UIImage imageWithCGImage:ref];
	
	CGContextRelease(bitmap);
	CGImageRelease(ref);
    
    
    NSData *imageData = UIImageJPEGRepresentation(imageResult, 100);
    // setting up the URL to post to
    NSString *urlString = [NSString stringWithFormat:@"http://%@/ios_dev.php/event/uploadPhoto/eventId/%i/userSiteId/%i", serverAddress, eventId, userSiteId];
    
    // setting up the request object now
    NSMutableURLRequest *request = [[[NSMutableURLRequest alloc] init] autorelease];
    [request setURL:[NSURL URLWithString:urlString]];
    [request setHTTPMethod:@"POST"];
    
    /*
     add some header info now
     we always need a boundary when we post a file
     also we need to set the content type
     
     You might want to generate a random boundary.. this is just the same
     as my output from wireshark on a valid html post
     */
    NSString *boundary = [NSString stringWithString:@"---------------------------14737809831466499882746641449"];
    NSString *contentType = [NSString stringWithFormat:@"multipart/form-data; boundary=%@",boundary];
    [request addValue:contentType forHTTPHeaderField: @"Content-Type"];
    
    /*
     now lets create the body of the post
     */
    NSMutableData *body = [NSMutableData data];
    [body appendData:[[NSString stringWithFormat:@"\r\n--%@\r\n",boundary] dataUsingEncoding:NSUTF8StringEncoding]];
    [body appendData:[[NSString stringWithString:@"Content-Disposition: form-data; name=\"Filedata\"; filename=\"ios_runtime_picture.jpg\"\r\n"] dataUsingEncoding:NSUTF8StringEncoding]];
    [body appendData:[[NSString stringWithString:@"Content-Type: application/octet-stream\r\n\r\n"] dataUsingEncoding:NSUTF8StringEncoding]];
    [body appendData:[NSData dataWithData:imageData]];
    [body appendData:[[NSString stringWithFormat:@"\r\n--%@--\r\n",boundary] dataUsingEncoding:NSUTF8StringEncoding]];
    // setting the body of the post to the reqeust
    [request setHTTPBody:body];
    
    // now lets make the connection to the web
    NSError *requestError  = nil;
    NSData *returnData     = [NSURLConnection sendSynchronousRequest:request returningResponse:nil error:&requestError];
    NSString *returnString = [[NSString alloc] initWithData:returnData encoding:NSUTF8StringEncoding];
    
    NSLog(@"returnString: %@", returnString);
    
    if( requestError!=nil )
        return NO;
    
    return YES;
}

- (NSString *)photoListPath {
    
    return pathInDocumentDirectory([NSString stringWithFormat:@"Event-%i-photo.data", eventId]);
}

@end