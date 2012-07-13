//
//  EventPlayerViewController.m
//  iRank
//
//  Created by Luciano Stegun on 01/05/2011.
//  Copyright (c) 2011 __MyCompanyName__. All rights reserved.
//

#import "EventPlayerViewController.h"
#import "Event.h"
#import "EventPlayer.h"
#import "Player.h"
#import "iRankAppDelegate.h"
#import "EventResultSaveViewController.h"
#import "AddPlayerViewController.h"

@implementation EventPlayerViewController
@synthesize event;
@synthesize showEnabledOnly;

- (id)initWithStyle:(UITableViewStyle)style
{
    self = [super initWithStyle:style];
    
//    self = [super initWithStyle:UITableViewStyleGrouped];
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

    doneButton = [[UIBarButtonItem alloc] initWithBarButtonSystemItem:UIBarButtonSystemItemDone target:self action:@selector(doneButtonTouchUp:)];
    addButton  = [[UIBarButtonItem alloc] initWithBarButtonSystemItem:UIBarButtonSystemItemAdd target:self action:@selector(addButtonTouchUp:)];
    
    [self setTitle:NSLocalizedString(@"Players", @"eventPlayer")];
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
    
    if( [event eventPlayerList]==nil ){
        
        [self updatePlayerList];
    }else{
        
        [self configureView];
        
        [[self tableView] reloadData];
    }
}

- (void)viewDidAppear:(BOOL)animated
{
    [super viewDidAppear:animated];
}

- (void)viewWillDisappear:(BOOL)animated
{
    [super viewWillDisappear:animated];
    
    if( !showEnabledOnly && [eventPlayerList count] > 0 )
        [event setEventPlayerList:eventPlayerList];
}

- (void)viewDidDisappear:(BOOL)animated
{
    [super viewDidDisappear:animated];
}

- (void)addButtonTouchUp:(id)sender {
    
    AddPlayerViewController *addPlayerViewController = [[AddPlayerViewController alloc] initWithStyle:UITableViewStyleGrouped];
    
    addPlayerViewController.rankingId = event.rankingId;
    addPlayerViewController.eventId   = event.eventId;
    
    [self.navigationController pushViewController:addPlayerViewController animated:YES];
    [addPlayerViewController release];
}

- (void)updatePlayerList {

    [appDelegate showLoadingView:NSLocalizedString(@"Loading player list...", @"eventPlayer")];
    [[NSNotificationCenter defaultCenter] addObserver:self selector:@selector(handlePlayerList:) name:kEventPlayerListLoadSuccess object:nil];
    [self performSelector:@selector(updateEventPlayerList) withObject:nil afterDelay:0.1];
}

- (void)handlePlayerList:(NSNotification *)notice {
    
    [appDelegate hideLoadingView];
    
    [self configureView];
    
    [[self tableView] reloadData];
    
    [[NSNotificationCenter defaultCenter] removeObserver:kEventPlayerListLoadSuccess];
}

-(void)updateEventPlayerList {
    
    [event reloadPlayerList:self];
}

- (void)configureView {
    
    if( [self showEnabledOnly] && [event isMyEvent] ){
        
        eventPlayerList = [event getFilteredPlayerList];
        
        if( [eventPlayerList count] > 0 )
            self.navigationItem.rightBarButtonItem = doneButton;
        else
            self.navigationItem.rightBarButtonItem = nil;
        
        [self setEditing:YES animated:NO];
    }else{
        
        if( [event isEditable] && [event isMyEvent] )
            self.navigationItem.rightBarButtonItem = addButton;
        else
            self.navigationItem.rightBarButtonItem = nil;
        
        eventPlayerList = [event eventPlayerList];
        
        [self setEditing:NO animated:NO];
    }
}

-(void)updatePlayerList:(id)sender {
    
    [self updatePlayerList];
}

-(void)doneButtonTouchUp:(id)sender {
    
    EventResultSaveViewController *eventResultSaveViewController = [[EventResultSaveViewController alloc] initWithNibName:nil bundle:nil];
    
    eventResultSaveViewController.event           = event;
    eventResultSaveViewController.eventPlayerList = eventPlayerList;

    [self.navigationController pushViewController:eventResultSaveViewController animated:YES];
    
//    [eventResultSaveViewController release];
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

    return [eventPlayerList count];
}

- (UITableViewCell *)tableView:(UITableView *)tableView cellForRowAtIndexPath:(NSIndexPath *)indexPath
{
        
    EventPlayer *eventPlayer = [eventPlayerList objectAtIndex:indexPath.row];
    Player *player = [eventPlayer player];
    
    NSString *CellIdentifier = [NSString stringWithFormat:@"CellEventPlayer%@", eventPlayer.inviteStatus];
    
    UITableViewCell *cell = [tableView dequeueReusableCellWithIdentifier:CellIdentifier];

    if (cell == nil)
        cell = [[[UITableViewCell alloc] initWithStyle:UITableViewCellStyleSubtitle reuseIdentifier:CellIdentifier] autorelease];

    
    if( ![self showEnabledOnly] ){
       
        UIButton *button = [UIButton buttonWithType:UIButtonTypeDetailDisclosure];
        button.tag = indexPath.row;
        
        if( [eventPlayer.inviteStatus isEqualToString:@"yes"] ){
            
            [button setImage:[UIImage imageNamed:@"ok.png"] forState:UIControlStateNormal];
            [button setImage:[UIImage imageNamed:([event isMyEvent] && [event isEditable]?@"okH.png":@"ok.png")] forState:UIControlStateHighlighted];
        }
        else if( [eventPlayer.inviteStatus isEqualToString:@"no"] ){
            
            [button setImage:[UIImage imageNamed:@"nok.png"] forState:UIControlStateNormal];
            [button setImage:[UIImage imageNamed:([event isMyEvent] && [event isEditable]?@"nokH.png":@"nok.png")] forState:UIControlStateHighlighted];
        }
        else{
            
            [button setImage:[UIImage imageNamed:@"none.png"] forState:UIControlStateNormal];
            [button setImage:[UIImage imageNamed:([event isMyEvent] && [event isEditable]?@"noneH.png":@"none.png")] forState:UIControlStateHighlighted];
        }
        
        cell.accessoryView = button;
        
        if( [event isMyEvent] && [event isEditable] ){

            [button addTarget:self action:@selector(accessoryClicked:) forControlEvents:UIControlEventTouchUpInside];
            cell.accessoryView.userInteractionEnabled = YES;
        }
    }else{
        
        cell.accessoryView.userInteractionEnabled = NO;
        eventPlayer.eventPosition = indexPath.row+1;
    }
    
//    [button release];

    if( [self showEnabledOnly] )
        cell.textLabel.text = [NSString stringWithFormat:@"%iº %@", indexPath.row+1, [player fullName]];
    else
        cell.textLabel.text = [player fullName];
    
    cell.detailTextLabel.text = [player emailAddress];
        
    player = nil;
    eventPlayer = nil;
    
    return cell;
}

-(void)accessoryClicked:(id)sender {
    
    UIButton *button         = (UIButton *)sender;
    EventPlayer *eventPlayer = [eventPlayerList objectAtIndex:button.tag];
    
    NSString *inviteStatus = eventPlayer.inviteStatus;
    
    if( [inviteStatus isEqualToString:@"yes"] ){
        
        [button setImage:[UIImage imageNamed:@"nok.png"] forState:UIControlStateNormal];
        [button setImage:[UIImage imageNamed:@"nokH.png"] forState:UIControlStateHighlighted];
        [eventPlayer togglePresence:@"no"];
    }else{
        
        [button setImage:[UIImage imageNamed:@"ok.png"] forState:UIControlStateNormal];
        [button setImage:[UIImage imageNamed:@"okH.png"] forState:UIControlStateHighlighted];
        [eventPlayer togglePresence:@"yes"];
    }
}

// Override to support conditional editing of the table view.
- (BOOL)tableView:(UITableView *)tableView canEditRowAtIndexPath:(NSIndexPath *)indexPath
{
    // Return NO if you do not want the specified item to be editable.
    return YES;
}


// Override to support editing the table view.
- (void)tableView:(UITableView *)tableView commitEditingStyle:(UITableViewCellEditingStyle)editingStyle forRowAtIndexPath:(NSIndexPath *)indexPath
{
//    if (editingStyle == UITableViewCellEditingStyleDelete) {
//        // Delete the row from the data source
//        [tableView deleteRowsAtIndexPaths:[NSArray arrayWithObject:indexPath] withRowAnimation:UITableViewRowAnimationFade];
//    }   
//    else if (editingStyle == UITableViewCellEditingStyleInsert) {
//        // Create a new instance of the appropriate class, insert it into the array, and add a new row to the table view
//    }   
    
    
}


// Override to support rearranging the table view.
- (void)tableView:(UITableView *)tableView moveRowAtIndexPath:(NSIndexPath *)fromIndexPath toIndexPath:(NSIndexPath *)toIndexPath
{
    
    // Get pointer to object being moved
    EventPlayer *eventPlayer = [eventPlayerList objectAtIndex:[fromIndexPath row]];
    
    // Retain p so that it is not deallocated whem it is removed from the array
    [eventPlayer retain]; // Retain count of p is now 2
    
    // Remove p from our array, it is automatically sent release
    [eventPlayerList removeObjectAtIndex:[fromIndexPath row]]; // Retain count of p is now 1
    
    // Re-inser p into array at new location, it is automatically retained
    [eventPlayerList insertObject:eventPlayer atIndex:[toIndexPath row]]; // Retain count of p is now 2
    
    // Release p
    [eventPlayer release]; // Retain count of p is now 1
    
    eventPlayerList = eventPlayerList;
    [self.tableView reloadData];
}



// Override to support conditional rearranging of the table view.
- (BOOL)tableView:(UITableView *)tableView canMoveRowAtIndexPath:(NSIndexPath *)indexPath
{
    // Return NO if you do not want the item to be re-orderable.
    return YES;
}

-(UITableViewCellEditingStyle)tableView:(UITableView *)tableView editingStyleForRowAtIndexPath:(NSIndexPath *)indexPath {
    
    return UITableViewCellEditingStyleNone;
}


#pragma mark - Table view delegate

- (void)tableView:(UITableView *)tableView didSelectRowAtIndexPath:(NSIndexPath *)indexPath
{
    // Navigation logic may go here. Create and push another view controller.
    /*
     <#DetailViewController#> *detailViewController = [[<#DetailViewController#> alloc] initWithNibName:@"<#Nib name#>" bundle:nil];
     // ...
     // Pass the selected object to the new view controller.
     [self.navigationController pushViewController:detailViewController animated:YES];
     [detailViewController release];
     */
}

- (void) dealloc {
    
    [event release];
    [super dealloc];
}

@end
