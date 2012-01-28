//
//  ConfigViewController.m
//  iRank
//
//  Created by Luciano Stegun on 01/05/2011.
//  Copyright (c) 2011 __MyCompanyName__. All rights reserved.
//

#import "ConfigViewController.h"
#import "iRankAppDelegate.h"

@implementation ConfigViewController

- (id)initWithNibName:(NSString *)nibNameOrNil bundle:(NSBundle *)nibBundleOrNil
{
    self = [super initWithNibName:nibNameOrNil bundle:nibBundleOrNil];
    if (self) {
        // Custom initialization
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

- (void)viewDidLoad
{
    [super viewDidLoad];
    
    appDelegate = (iRankAppDelegate *)[[UIApplication sharedApplication] delegate];
    
//    UIBarButtonItem *accountButton = [[UIBarButtonItem alloc] initWithTitle:@"conta" style:UIBarButtonItemStylePlain target:self action:@selector(accountButtonTouchUp:)];
    
    self.navigationController.navigationBar.barStyle = UIBarStyleBlackOpaque;
    
//    self.navigationItem.rightBarButtonItem = accountButton;
    
    [lblHomeEvents setText:NSLocalizedString(@"lblHomeEvents", @"config")];
    [lblSaveOffline setText:NSLocalizedString(@"Save offline", @"config")];
    [lblSaveOfflineInfo setText:NSLocalizedString(@"lblSaveOfflineInfo", @"config")];
    [lblCompressPhoto setText:NSLocalizedString(@"lblCompressPhoto", @"config")];
}

- (void)viewDidUnload
{
    [super viewDidUnload];
    // Release any retained subviews of the main view.
    // e.g. self.myOutlet = nil;
}

- (void)viewWillAppear:(BOOL)animated {
    
    NSNumber *homeEvents   = [[appDelegate userDefaults] objectForKey:kHomeEventLimitKey];
    BOOL saveResultOffline = [[appDelegate userDefaults] boolForKey:kSaveOfflineKey];
    float photoCompress    = [[appDelegate userDefaults] floatForKey:kPhotoCompressKey];
    
//    NSLog(@"saveResultOffline: %@", (saveResultOffline?@"YES":@"NO"));
    
    switch ([homeEvents intValue]) {
        default:
        case 5:
            [homeEventsSegmendetControl setSelectedSegmentIndex:0];
            break;
        case 10:
            [homeEventsSegmendetControl setSelectedSegmentIndex:1];
            break;
        case 15:
            [homeEventsSegmendetControl setSelectedSegmentIndex:2];
            break;
        case 20:
            [homeEventsSegmendetControl setSelectedSegmentIndex:3];
            break;
    }
    
    [saveResultOfflineSwitch setOn:saveResultOffline];
    
    [photoCompressSlider setValue:photoCompress];
    lblPhotoCompress.text = [NSString stringWithFormat:@"%i%%", (int)photoCompress];
    
//    [homeEvents release];
    
    self.title = NSLocalizedString(@"Options", @"config");
}

- (BOOL)shouldAutorotateToInterfaceOrientation:(UIInterfaceOrientation)interfaceOrientation
{
    // Return YES for supported orientations
    return YES;//(interfaceOrientation == UIInterfaceOrientationPortrait);
}

-(void)didSelectEventCount:(id)sender {
    
    NSNumber *homeEvents = [[NSNumber alloc] initWithInt:5];
    
    switch ([sender selectedSegmentIndex]) {
        case 0:
            homeEvents = [NSNumber numberWithInt:5];
            break;
        case 1:
            homeEvents = [NSNumber numberWithInt:10];
            break;
        case 2:
            homeEvents = [NSNumber numberWithInt:15];
            break;
        case 3:
            homeEvents = [NSNumber numberWithInt:20];
            break;
        default:
            break;
    }
    
    NSLog(@"homeEvents: %@", homeEvents);

    [[appDelegate userDefaults] setObject:homeEvents forKey:kHomeEventLimitKey];
    [[appDelegate userDefaults] synchronize];
    
//    [homeEvents release];
}

-(void)changeSaveResultOffline:(id)sender {
    
    NSLog(@"saveResultOffline: %@", ([saveResultOfflineSwitch isSelected]?@"YES":@"NO"));
    
    [[appDelegate userDefaults] setBool:[saveResultOfflineSwitch isOn] forKey:kSaveOfflineKey];
    [[appDelegate userDefaults] synchronize];
}

-(void)changePhotoCompress:(id)sender {
    
    float photoCompress = (int)photoCompressSlider.value;
    
    lblPhotoCompress.text = [NSString stringWithFormat:@"%i%%", (int)photoCompress];
    
    [[appDelegate userDefaults] setFloat:photoCompress forKey:kPhotoCompressKey];
    [[appDelegate userDefaults] synchronize];
}

-(void)accountButtonTouchUp:(id)sender {
    
    if( accountViewController==nil )
        accountViewController = [[AccountViewController alloc] initWithStyle:UITableViewStyleGrouped];
    
    [self.navigationController pushViewController:accountViewController animated:YES];
}


@end
