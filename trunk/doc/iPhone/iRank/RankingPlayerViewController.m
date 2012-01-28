//
//  RankingPlayerViewController.m
//  iRank
//
//  Created by Luciano Stegun on 01/05/2011.
//  Copyright (c) 2011 __MyCompanyName__. All rights reserved.
//

#import "RankingPlayerViewController.h"
#import "iRankAppDelegate.h"
#import "RankingPlayer.h"
#import "AddPlayerViewController.h"

@implementation RankingPlayerViewController
@synthesize ranking;
@synthesize sortByPosition;
@synthesize rankingPlayerList;

- (id)initWithStyle:(UITableViewStyle)style
{
    self = [super initWithStyle:style];
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
    
    // Uncomment the following line to preserve selection between presentations.
    // self.clearsSelectionOnViewWillAppear = NO;
    
    // Uncomment the following line to display an Edit button in the navigation bar for this view controller.
    // self.navigationItem.rightBarButtonItem = self.editButtonItem;
    
    appDelegate = (iRankAppDelegate *)[[UIApplication sharedApplication] delegate];
    addButton   = [[UIBarButtonItem alloc] initWithBarButtonSystemItem:UIBarButtonSystemItemAdd target:self action:@selector(addButtonTouchUp:)];
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
    
    if( ranking.rankingPlayerList==nil ){
        
        [appDelegate showLoadingView:NSLocalizedString(@"loading player list...", @"rankingPlayer")];
        [self performSelector:@selector(updateRankingPlayerList) withObject:nil afterDelay:0.1];        
    }else{
        
        if( sortByPosition )
            rankingPlayerList = [ranking sortedRankingPlayerList];
        else
            rankingPlayerList = ranking.rankingPlayerList;
    }
    
    if( ranking.isMyRanking && !sortByPosition )
        self.navigationItem.rightBarButtonItem = addButton;
    else
        self.navigationItem.rightBarButtonItem = nil;
    
    if( sortByPosition )
        self.title = NSLocalizedString(@"Ranking", @"rankingPlayer");
    else
        self.title = NSLocalizedString(@"Players", @"rankingPlayer");
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
    return sortByPosition;
}

- (void)addButtonTouchUp:(id)sender {
    
    AddPlayerViewController *addPlayerViewController = [[AddPlayerViewController alloc] initWithStyle:UITableViewStyleGrouped];
    
    addPlayerViewController.rankingId = ranking.rankingId;
    
    [self.navigationController pushViewController:addPlayerViewController animated:YES];
    [addPlayerViewController release];
}

- (void)updateRankingPlayerList {
    
    [ranking loadPlayerList];
    
    if( sortByPosition )
        rankingPlayerList = [ranking sortedRankingPlayerList];
    else
        rankingPlayerList = ranking.rankingPlayerList;
    
    [appDelegate hideLoadingView];
    [[self tableView] reloadData];
}

#pragma mark - Table view data source

- (NSInteger)numberOfSectionsInTableView:(UITableView *)tableView
{
    
    return 1;
}

- (NSInteger)tableView:(UITableView *)tableView numberOfRowsInSection:(NSInteger)section
{
    
    return [rankingPlayerList count];
}

- (UITableViewCell *)tableView:(UITableView *)tableView cellForRowAtIndexPath:(NSIndexPath *)indexPath
{
    static NSString *CellIdentifier = @"Cell";
    
    UITableViewCell *cell = [tableView dequeueReusableCellWithIdentifier:CellIdentifier];
    if (cell == nil) {
        cell = [[[UITableViewCell alloc] initWithStyle:UITableViewCellStyleSubtitle reuseIdentifier:CellIdentifier] autorelease];
    }
    
    RankingPlayer *rankingPlayer = [rankingPlayerList objectAtIndex:indexPath.row];
    
    NSString *label;
    NSString *description;
    NSString *pluralEvents = ([rankingPlayer totalEvents]==1?@"":NSLocalizedString(@"pluralEvents", @"rankingPlayer"));
    
    if( sortByPosition ){
        
        NSNumberFormatter *numberFormatter = [[NSNumberFormatter alloc] init];
        [numberFormatter setNumberStyle:NSNumberFormatterCurrencyStyle];
        [numberFormatter setDecimalSeparator:@","];
        [numberFormatter setCurrencyCode:@""];
        [numberFormatter setCurrencySymbol:@""];
        [numberFormatter setMinimumFractionDigits:3];
        
        label       = [NSString stringWithFormat:@"#%i %@", (indexPath.row+1), [[rankingPlayer player] fullName]];
        description = [NSString stringWithFormat:@"%i %@%@, %@ %@. %@: %@", [rankingPlayer totalEvents], NSLocalizedString(@"event", @"rankingPlayer"), pluralEvents, [numberFormatter stringFromNumber:[NSNumber numberWithFloat:rankingPlayer.totalScore]], NSLocalizedString(@"score", @"rankingPlayer"), NSLocalizedString(@"Average", @"rankingPlayer"), [numberFormatter stringFromNumber:[NSNumber numberWithFloat:rankingPlayer.totalAverage]]];
    }else{
        
        label       = [NSString stringWithFormat:@"%@", [[rankingPlayer player] fullName]];
        description = [NSString stringWithFormat:@"%@, %i %@%@", [[rankingPlayer player] emailAddress], [rankingPlayer totalEvents], NSLocalizedString(@"event", @"rankingPlayer"), pluralEvents];
    }
    
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
    // Navigation logic may go here. Create and push another view controller.
    /*
     <#DetailViewController#> *detailViewController = [[<#DetailViewController#> alloc] initWithNibName:@"<#Nib name#>" bundle:nil];
     // ...
     // Pass the selected object to the new view controller.
     [self.navigationController pushViewController:detailViewController animated:YES];
     [detailViewController release];
     */
}

- (void)dealloc {
    
    [super dealloc];
}

@end
