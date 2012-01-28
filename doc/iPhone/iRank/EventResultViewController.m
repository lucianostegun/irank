//
//  EventResultViewController.m
//  iRank
//
//  Created by Luciano Stegun on 01/05/2011.
//  Copyright (c) 2011 __MyCompanyName__. All rights reserved.
//

#import "EventResultViewController.h"
#import "Event.h"
#import "EventPlayer.h"
#import "iRankAppDelegate.h"
#import "XMLEventPlayerParser.h"

@implementation EventResultViewController
@synthesize event;
@synthesize eventPlayerList;

-(id)initWithNibName:(NSString *)nibNameOrNil bundle:(NSBundle *)nibBundleOrNil {

    self = [super initWithNibName:nibNameOrNil bundle:nibBundleOrNil];
    
    if (self) {
        
        numberFormatter = [[NSNumberFormatter alloc] init];
        [numberFormatter setNumberStyle:NSNumberFormatterCurrencyStyle];
        [numberFormatter setDecimalSeparator:@","];
        [numberFormatter setCurrencyCode:@""];
        [numberFormatter setCurrencySymbol:@""];
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
    
    if( [[event eventPlayerList] count]==0 )
        [self updatePlayerList];
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

- (void)updatePlayerList {
    
    [appDelegate showLoadingView:NSLocalizedString(@"loading result...", @"eventResult")];
    [[NSNotificationCenter defaultCenter] addObserver:self selector:@selector(handlePlayerList:) name:kEventPlayerListLoadSuccess object:nil];
    [self performSelector:@selector(updateEventPlayerList) withObject:nil afterDelay:0.1];
}

- (void)updateEventPlayerList {
    
    [event reloadPlayerList:self];
}

- (void)handlePlayerList:(NSNotification *)notice {
    
    [appDelegate hideLoadingView];
    
    eventPlayerList = [event getFilteredPlayerList];
    
    [tableView reloadData];
    
    [[NSNotificationCenter defaultCenter] removeObserver:kEventPlayerListLoadSuccess];
}

- (BOOL)shouldAutorotateToInterfaceOrientation:(UIInterfaceOrientation)interfaceOrientation
{

   return (interfaceOrientation == UIInterfaceOrientationLandscapeLeft || interfaceOrientation == UIInterfaceOrientationLandscapeRight);
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
    static NSString *CellIdentifier = @"Cell";
    
    UITableViewCell *cell = [tableView dequeueReusableCellWithIdentifier:CellIdentifier];
    
    if (cell == nil)
        cell = [[[UITableViewCell alloc] initWithStyle:UITableViewCellStyleSubtitle reuseIdentifier:CellIdentifier] autorelease];
    
    
    EventPlayer *eventPlayer = [eventPlayerList objectAtIndex:indexPath.row];
    Player *player = [eventPlayer player];
    
//    NSLog(@"eventPlayer: %@", eventPlayer);
    
    cell.textLabel.text       = [NSString stringWithFormat:@"%i%@ %@", indexPath.row+1, NSLocalizedString(@"ordinalPlace", nil), [player fullName]];
    cell.detailTextLabel.text = [NSString stringWithFormat:@"%@: %@ %@: %@ %@: %@ %@: %@ | %@ %@", [numberFormatter stringFromNumber:[NSNumber numberWithFloat:eventPlayer.buyin]], NSLocalizedString(@"B", nil), [numberFormatter stringFromNumber:[NSNumber numberWithFloat:eventPlayer.rebuy]], NSLocalizedString(@"R", nil), [numberFormatter stringFromNumber:[NSNumber numberWithFloat:eventPlayer.addon]], NSLocalizedString(@"A", nil), NSLocalizedString(@"Prize", @"eventResult"), [numberFormatter stringFromNumber:[NSNumber numberWithFloat:eventPlayer.prize]], [numberFormatter stringFromNumber:[NSNumber numberWithFloat:eventPlayer.score]], NSLocalizedString(@"score", @"eventResult")];
    
    cell.accessoryType = UITableViewCellAccessoryDisclosureIndicator;
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

    EventPlayer *eventPlayer = [eventPlayerList objectAtIndex:indexPath.row];
    
    resultDetailViewController.title = NSLocalizedString(@"Details", @"eventResult");
    playerName.text     = [[eventPlayer player] fullName];
    eventPlaceDate.text = [NSString stringWithFormat:@"%@ @%@ - %@ %@", [event eventName], [event eventPlace], [event eventDate], [event startTime]];
    
    position.text       = [NSString stringWithFormat:@"%i%@", indexPath.row+1, NSLocalizedString(@"ordinalPlace", nil)];
    buyin.text          = [numberFormatter stringFromNumber:[NSNumber numberWithFloat:eventPlayer.buyin]];
    rebuy.text          = [numberFormatter stringFromNumber:[NSNumber numberWithFloat:eventPlayer.rebuy]];
    addon.text          = [numberFormatter stringFromNumber:[NSNumber numberWithFloat:eventPlayer.addon]];
    prize.text          = [numberFormatter stringFromNumber:[NSNumber numberWithFloat:eventPlayer.prize]];
    score.text          = [numberFormatter stringFromNumber:[NSNumber numberWithFloat:eventPlayer.score]];
    
    [self.navigationController pushViewController:resultDetailViewController animated:YES];
}

-(void)dealloc {
    
//    [resultDetailViewController release];
    [event release];
    [super dealloc];
}

@end
