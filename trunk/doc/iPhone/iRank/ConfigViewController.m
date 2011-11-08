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
}

- (void)viewDidUnload
{
    [super viewDidUnload];
    // Release any retained subviews of the main view.
    // e.g. self.myOutlet = nil;
}

- (void)viewWillAppear:(BOOL)animated {
    
    iRankAppDelegate *appDelegate = (iRankAppDelegate *)[[UIApplication sharedApplication] delegate];
    
    NSNumber *homeEvents = [[appDelegate userDefaults] objectForKey:@"homeEvents"];
    
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
    
//    [homeEvents release];
}

- (BOOL)shouldAutorotateToInterfaceOrientation:(UIInterfaceOrientation)interfaceOrientation
{
    // Return YES for supported orientations
    return (interfaceOrientation == UIInterfaceOrientationPortrait);
}

-(void)didSelectEventCount:(id)sender {
    
    iRankAppDelegate *appDelegate = (iRankAppDelegate *)[[UIApplication sharedApplication] delegate];
    
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

    [[appDelegate userDefaults] setObject:homeEvents forKey:@"homeEvents"];
    [[appDelegate userDefaults] synchronize];
    
//    [homeEvents release];
}


@end
