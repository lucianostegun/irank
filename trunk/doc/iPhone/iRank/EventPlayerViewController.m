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
#import "XMLEventPlayerParser.h"
#import "iRankAppDelegate.h"
#import "Constants.h"
#import "EventResultSaveViewController.h"

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
    
    doneButton = [[UIBarButtonItem alloc] initWithBarButtonSystemItem:UIBarButtonSystemItemDone target:self action:@selector(doneButtonTouchUp:)];
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
    
    int userSiteId = [(iRankAppDelegate *)[[UIApplication sharedApplication] delegate] userSiteId];
    
    NSURL *url = [[NSURL alloc] initWithString:[NSString stringWithFormat:@"http://%@/ios.php/event/getXml/model/eventPlayer/userSiteId/%i/eventId/%d", serverAddress, userSiteId, event.eventId]];

    NSXMLParser *xmlParser = [[NSXMLParser alloc] initWithContentsOfURL:url];    
    
    //Inicia o delegate
    XMLEventPlayerParser *parser = [[XMLEventPlayerParser alloc] initXMLParser];
    
    [xmlParser setDelegate:parser];
    
    BOOL success = [xmlParser parse];
    
    iRankAppDelegate *appDelegate = (iRankAppDelegate *)[[UIApplication sharedApplication] delegate];
    
    if( !success ) 
        return [appDelegate showAlert:@"Erro" message:@"Não foi possível recuperar a lista de jogadores."];
                  
    [event setEventPlayerList: [[parser getEventPlayerList] retain]];
    
    
    if( [self showEnabledOnly] && [event isMyEvent] ){
        
        [event filterPlayerList];
        [self setEditing:YES animated:NO];
        self.navigationItem.rightBarButtonItem = doneButton;
    }else{
        
        [self setEditing:NO animated:NO];
        self.navigationItem.rightBarButtonItem = nil;
    }
    
    [self setTitle:@"Convidados"];
    [[self tableView] reloadData];    
}

-(void)doneButtonTouchUp:(id)sender {
    
    EventResultSaveViewController *eventResultSaveViewController = [[EventResultSaveViewController alloc] initWithNibName:nil bundle:nil];
    
    eventResultSaveViewController.event = event;
    [self.navigationController pushViewController:eventResultSaveViewController animated:YES];
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
    return (interfaceOrientation == UIInterfaceOrientationPortrait);
}

#pragma mark - Table view data source

- (NSInteger)numberOfSectionsInTableView:(UITableView *)tableView
{
    return 1;
}

- (NSInteger)tableView:(UITableView *)tableView numberOfRowsInSection:(NSInteger)section
{

    return [event.eventPlayerList count];
}

- (UITableViewCell *)tableView:(UITableView *)tableView cellForRowAtIndexPath:(NSIndexPath *)indexPath
{
    
    EventPlayer *eventPlayer = [[event eventPlayerList] objectAtIndex:indexPath.row];
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
            [button setImage:[UIImage imageNamed:([event isMyEvent]?@"okH.png":@"ok.png")] forState:UIControlStateHighlighted];
        }
        else if( [eventPlayer.inviteStatus isEqualToString:@"no"] ){
            
            [button setImage:[UIImage imageNamed:@"nok.png"] forState:UIControlStateNormal];
            [button setImage:[UIImage imageNamed:([event isMyEvent]?@"nokH.png":@"nok.png")] forState:UIControlStateHighlighted];
        }
        else{
            
            [button setImage:[UIImage imageNamed:@"none.png"] forState:UIControlStateNormal];
            [button setImage:[UIImage imageNamed:([event isMyEvent]?@"noneH.png":@"none.png")] forState:UIControlStateHighlighted];
        }
        
        cell.accessoryView = button;
        
        if( [event isMyEvent] ){

            [button addTarget:self action:@selector(accessoryClicked:) forControlEvents:UIControlEventTouchUpInside];
            cell.accessoryView.userInteractionEnabled = YES;
        }
    }else{
        
        cell.accessoryView.userInteractionEnabled = NO;
    }

    eventPlayer.eventPosition = indexPath.row+1;
    
//    [button release];

    cell.textLabel.text       = [NSString stringWithFormat:@"%iº %@", indexPath.row+1, [player fullName]];
    cell.detailTextLabel.text = [player emailAddress];
        
    player = nil;
    eventPlayer = nil;
    
    return cell;
}

-(void)accessoryClicked:(id)sender {
    
    UIButton *button         = (UIButton *)sender;
    EventPlayer *eventPlayer = [[event eventPlayerList] objectAtIndex:button.tag];
    
    NSString *inviteStatus = eventPlayer.inviteStatus;
    
    NSLog(@"clicou no botão: %@", inviteStatus);
    
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
    
    NSMutableArray *eventPlayerList = [event eventPlayerList];
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
    
    event.eventPlayerList = eventPlayerList;
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
