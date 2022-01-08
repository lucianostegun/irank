//
//  EventViewController.m
//  iRank
//
//  Created by Luciano Stegun on 01/05/2011.
//  Copyright (c) 2011 __MyCompanyName__. All rights reserved.
//

#import "EventViewController.h"
#import "EventEditViewController.h"
#import "iRankAppDelegate.h"
#import "Event.h"
#import "XMLEventParser.h"

@implementation EventViewController
@synthesize eventList;
@synthesize rankingId;

- (id)initWithStyle:(UITableViewStyle)style
{
    self = [super initWithStyle:style];
    if (self) {
    }
    return self;
}

- (id)initWithStyle:(UITableViewStyle)style rankingId:(int)theRankingId
{
    self = [super initWithStyle:style];
    
    if (self) {

        self.rankingId = theRankingId;
    }
    
    return self;
}

- (void)addEvent:(id)sender{
    
    EventEditViewController *eventEditViewController = [[EventEditViewController alloc] initWithStyle:UITableViewStyleGrouped];
    [self.navigationController pushViewController:eventEditViewController animated:YES];
    
    [eventEditViewController release];
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

    // Uncomment the following line to preserve selection between presentations.
    // self.clearsSelectionOnViewWillAppear = NO;
 
    // Uncomment the following line to display an Edit button in the navigation bar for this view controller.
    // self.navigationItem.rightBarButtonItem = self.editButtonItem;
    
    self.navigationController.navigationBar.barStyle = UIBarStyleBlackOpaque;
    
    appDelegate = (iRankAppDelegate *)[[UIApplication sharedApplication] delegate];
    
//    UIBarButtonItem *addEvent = [[UIBarButtonItem alloc] initWithBarButtonSystemItem:UIBarButtonSystemItemAdd target:self action:@selector(addEvent:)];
//    
//    self.navigationItem.rightBarButtonItem = addEvent;
    
//    NSLog(@"retainCount: %i", self.retainCount);
    
    [appDelegate showLoadingView:nil];
    [self performSelector:@selector(updateEventList) withObject:nil afterDelay:0.1];
}

- (void)updateEventList {

    int userSiteId = [appDelegate userSiteId];
    NSLog(@"rankingId: %i", rankingId);
    eventList = [Event loadEventList:@"list" userSiteId:userSiteId limit:0 rankingId:rankingId];
    
    [appDelegate hideLoadingView];
    [[self tableView] reloadData];
}

- (void)viewDidUnload
{
    [super viewDidUnload];
    // Release any retained subviews of the main view.
    // e.g. self.myOutlet = nil;
}

- (void)viewWillAppear:(BOOL)animated
{
    [super viewWillAppear:animated];
    
    if( appDelegate.refreshEventList ){

        [appDelegate showLoadingView:nil];
        [self performSelector:@selector(updateEventList) withObject:nil afterDelay:0.1];
        
        appDelegate.refreshEventList = NO;
    }
    
    self.title = NSLocalizedString(@"Events", nil);
}

- (void)viewDidAppear:(BOOL)animated
{
    [super viewDidAppear:animated];
}

- (void)viewWillDisappear:(BOOL)animated
{
    [super viewWillDisappear:animated];
}

- (void)viewDidDisappear:(BOOL)animated
{
    [super viewDidDisappear:animated];
}

- (BOOL)shouldAutorotateToInterfaceOrientation:(UIInterfaceOrientation)interfaceOrientation
{
    // Return YES for supported orientations
    return YES;//(interfaceOrientation == UIInterfaceOrientationPortrait);
}

#pragma mark - Table view data source

- (NSInteger)numberOfSectionsInTableView:(UITableView *)tableView
{

    return 1;
}

- (NSInteger)tableView:(UITableView *)tableView numberOfRowsInSection:(NSInteger)section
{

    return [eventList count];
}

- (UITableViewCell *)tableView:(UITableView *)tableView cellForRowAtIndexPath:(NSIndexPath *)indexPath
{
    static NSString *CellIdentifier = @"Cell";
    
    UITableViewCell *cell = [tableView dequeueReusableCellWithIdentifier:CellIdentifier];
    if (cell == nil) {
        cell = [[[UITableViewCell alloc] initWithStyle:UITableViewCellStyleSubtitle reuseIdentifier:CellIdentifier] autorelease];
    }
    
    NSString *label = [[[NSString alloc] init] autorelease];
    NSString *description = [[[NSString alloc] init] autorelease];
    
    Event *event = [[eventList objectAtIndex:indexPath.row] retain];
    
    label       = [event eventName];
    description = [NSString stringWithFormat:@"%@ %@ @%@", [event eventDate], [event startTime], [event eventPlace]];
    cell.accessoryType = UITableViewCellAccessoryDisclosureIndicator;
    
    if( event.hasOfflineResult ){
        
        cell.detailTextLabel.textColor = [UIColor orangeColor];
        description = NSLocalizedString(@"Pending offline saved", @"event");
    }else if( event.isPastDate && !event.savedResult ){
        
        cell.detailTextLabel.textColor = [UIColor redColor];
        description = NSLocalizedString(@"Pending result", @"event");
    }else{
        
        cell.detailTextLabel.textColor = [UIColor blackColor];
    }
    
    [event release];

    cell.textLabel.text       = label;
    cell.detailTextLabel.text = description;
    
    return cell;
}

/*
// Override to support conditional editing of the table view.
- (BOOL)tableView:(UITableView *)tableView canEditRowAtIndexPath:(NSIndexPath *)indexPath
{
    // Return NO if you do not want the specified item to be editable.
    return YES;
}
*/

/*
// Override to support editing the table view.
- (void)tableView:(UITableView *)tableView commitEditingStyle:(UITableViewCellEditingStyle)editingStyle forRowAtIndexPath:(NSIndexPath *)indexPath
{
    if (editingStyle == UITableViewCellEditingStyleDelete) {
        // Delete the row from the data source
        [tableView deleteRowsAtIndexPaths:[NSArray arrayWithObject:indexPath] withRowAnimation:UITableViewRowAnimationFade];
    }   
    else if (editingStyle == UITableViewCellEditingStyleInsert) {
        // Create a new instance of the appropriate class, insert it into the array, and add a new row to the table view
    }   
}
*/

/*
// Override to support rearranging the table view.
- (void)tableView:(UITableView *)tableView moveRowAtIndexPath:(NSIndexPath *)fromIndexPath toIndexPath:(NSIndexPath *)toIndexPath
{
}
*/

/*
// Override to support conditional rearranging of the table view.
- (BOOL)tableView:(UITableView *)tableView canMoveRowAtIndexPath:(NSIndexPath *)indexPath
{
    // Return NO if you do not want the item to be re-orderable.
    return YES;
}
*/

#pragma mark - Table view delegate

- (void)tableView:(UITableView *)tableView didSelectRowAtIndexPath:(NSIndexPath *)indexPath
{

    if( eventDetailViewController==nil )
        eventDetailViewController = [[EventDetailViewController alloc] initWithStyle:UITableViewStyleGrouped];
    
    Event *event;
    
        event = [[eventList objectAtIndex:indexPath.row] retain];
    
    eventDetailViewController.hidesBottomBarWhenPushed = YES;
    
    [eventDetailViewController setEvent:event];
    [self.navigationController pushViewController:eventDetailViewController animated:YES];
    
    [event release];
}

-(void)dealloc {
    
    [eventList release];
    [super dealloc];
}

@end
