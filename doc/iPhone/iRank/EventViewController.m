//
//  EventViewController.m
//  iRank
//
//  Created by Luciano Stegun on 01/05/2011.
//  Copyright 2011 __MyCompanyName__. All rights reserved.
//

#import "EventViewController.h"
#import "iRankAppDelegate.h"
#import "XMLEventParser.h"
#import "Event.h"
#import "Constants.h"

@implementation EventViewController
@synthesize appDelegate;
@synthesize detailViewController;
@synthesize userSiteId;

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
    
    self.navigationController.navigationBar.tintColor = [UIColor blackColor];
    
    if( userSiteId==nil )
        userSiteId = [[NSUserDefaults standardUserDefaults] objectForKey:kUserSiteIdKey];
    
    NSURL *url = [[NSURL alloc] initWithString:[NSString stringWithFormat:@"http://irank/index.php/event/getiPhoneAppXml/userSiteId/%@", userSiteId]];
    NSXMLParser *xmlParser = [[NSXMLParser alloc] initWithContentsOfURL:url];
    
    
    //Inicia o delegate
    XMLEventParser *parser = [[XMLEventParser alloc] initXMLParser];
    
    [xmlParser setDelegate:parser];
    
    if( appDelegate==nil )
        appDelegate = (iRankAppDelegate *)[[UIApplication sharedApplication] delegate];
    
    //Inicia o parse do arquivo
    BOOL success = [xmlParser parse];
    
    for(Event *aEvent in appDelegate.eventList) {
        
        aEvent.eventName = [aEvent.eventName stringByTrimmingCharactersInSet:[NSCharacterSet whitespaceAndNewlineCharacterSet]];
        aEvent.eventDate = [aEvent.eventDate stringByTrimmingCharactersInSet:[NSCharacterSet whitespaceAndNewlineCharacterSet]];
        aEvent.startTime = [aEvent.startTime stringByTrimmingCharactersInSet:[NSCharacterSet whitespaceAndNewlineCharacterSet]];
        aEvent.rankingName = [aEvent.rankingName stringByTrimmingCharactersInSet:[NSCharacterSet whitespaceAndNewlineCharacterSet]];
    }
    
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
    return (interfaceOrientation == UIInterfaceOrientationPortrait);
}










#pragma mark - Table view data source

- (NSInteger)numberOfSectionsInTableView:(UITableView *)tableView
{
    return 1;
}

- (NSInteger)tableView:(UITableView *)tableView numberOfRowsInSection:(NSInteger)section
{
    
    return [appDelegate.eventList count];
}

- (UITableViewCell *)tableView:(UITableView *)tableView cellForRowAtIndexPath:(NSIndexPath *)indexPath
{
    static NSString *CellIdentifier = @"Cell";
    
    UITableViewCell *cell = [tableView dequeueReusableCellWithIdentifier:CellIdentifier];
    if (cell == nil)
        cell = [[[UITableViewCell alloc] initWithStyle:UITableViewCellStyleSubtitle reuseIdentifier:CellIdentifier] autorelease];
    
    cell.accessoryType = UITableViewCellAccessoryDisclosureIndicator;
    
    Event *aEvent             = [appDelegate.eventList objectAtIndex:indexPath.row];    
    cell.textLabel.text       = aEvent.eventName;
    cell.detailTextLabel.text = [NSString stringWithFormat:@"%@ %@ - %@", aEvent.eventDate, aEvent.startTime, aEvent.rankingName];
    
    // Configure the cell.
    return cell;
}

- (UITableViewCell *)tableView:(UITableView * )tableView didSelectRowAtIndexPath:(NSIndexPath *)indexPath {
    
    Event *aEvent = [appDelegate.eventList objectAtIndex:indexPath.row];
	detailViewController.title = aEvent.eventName;
    
	[self.navigationController pushViewController:detailViewController animated:YES];
}


- (void)dealloc {
    
    [appDelegate release];
    [detailViewController release];
    [userSiteId release];
    [super dealloc];
}

@end
