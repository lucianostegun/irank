//
//  RankingDetailViewController.m
//  iRank
//
//  Created by Luciano Stegun on 01/05/2011.
//  Copyright (c) 2011 __MyCompanyName__. All rights reserved.
//

#import "RankingDetailViewController.h"
#import "RankingPlayerViewController.h"
#import "EventViewController.h"

@implementation RankingDetailViewController
@synthesize ranking;

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
    
    self.title = ranking.rankingName;
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

    return 2;
}

- (NSInteger)tableView:(UITableView *)tableView numberOfRowsInSection:(NSInteger)section
{

    int rows;
    
    switch ( section ) {
        case 0:
            rows = 8;
            break;
        case 1:
            rows = 3;
            break;
    }
    
    return rows;
}

- (UITableViewCell *)tableView:(UITableView *)tableView cellForRowAtIndexPath:(NSIndexPath *)indexPath
{
    NSString *CellIdentifier = [NSString stringWithFormat:@"CellSection%d", indexPath.section];
    
    if( indexPath.section==0 && indexPath.row==8 )
        CellIdentifier = @"CellComments";
    
    UITableViewCell *cell = [tableView dequeueReusableCellWithIdentifier:CellIdentifier];
    UITableViewCellStyle style = (indexPath.section==0?UITableViewCellStyleValue2:UITableViewCellStyleDefault);
    
    if (cell == nil) {
        cell = [[[UITableViewCell alloc] initWithStyle:style reuseIdentifier:CellIdentifier] autorelease];
    }
    
    NSString *label;
    NSString *description = @"";
    
    if( indexPath.section==0 ){
        
        NSNumberFormatter *numberFormatter = [[[NSNumberFormatter alloc] init] autorelease];
        [numberFormatter setNumberStyle:NSNumberFormatterCurrencyStyle];
        [numberFormatter setCurrencySymbol:@""];
        
        // Set to the current locale
        [numberFormatter setLocale:[NSLocale currentLocale]];
        
        switch (indexPath.row) {
            case 0:
                label = NSLocalizedString(@"Title", @"rankingDetails");
                description = ranking.rankingName;
                break;
            case 1:
                label = NSLocalizedString(@"Credit", @"rankingDetails");
                description = [numberFormatter stringFromNumber:[NSNumber numberWithFloat:ranking.credit]];
                break;
            case 2:
                label = NSLocalizedString(@"Style", @"rankingDetails");
                description = ranking.gameStyle;
                break;
            case 3:
                label = NSLocalizedString(@"Start", @"rankingDetails");
                description = ranking.startDate;
                break;
            case 4:
                label = NSLocalizedString(@"End", @"rankingDetails");
                description = ranking.finishDate;
                break;
            case 5:
                label = NSLocalizedString(@"Display", @"rankingDetails");
                description = (ranking.isPrivate?@"Privado":@"Público");
                break;
            case 6:
                label = NSLocalizedString(@"Classify", @"rankingDetails");
                description = ranking.rankingType;
                break;
            case 7:
                label = NSLocalizedString(@"Default buy-in", @"rankingDetails");
                description = [numberFormatter stringFromNumber:[NSNumber numberWithFloat:ranking.defaultBuyin]];
                break;
            default:
                break;
        }
        
        //        [numberFormatter release];
        
        cell.selectionStyle = UITableViewCellSelectionStyleNone;
    }else{
        
        description = @"";
        
        switch (indexPath.row) {
            case 0:
                label = NSLocalizedString(@"Players", @"rankingDetails");
                break;
            case 1:
                label = NSLocalizedString(@"Events", @"rankingDetails");
                break;
            case 2:
                label = NSLocalizedString(@"Ranking list", @"rankingDetails");
                break;
            case 3:
                label = NSLocalizedString(@"Options", @"rankingDetails");
                break;
                
            default:
                break;
        }
        
        cell.accessoryType = UITableViewCellAccessoryDisclosureIndicator;
    }
    
    cell.textLabel.text = label;
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

    if( indexPath.section==1 ){

        if( indexPath.row==0 || indexPath.row==2 ){
            
            RankingPlayerViewController *rankingPlayerViewController = [[RankingPlayerViewController alloc] initWithStyle:UITableViewStylePlain];
            
            rankingPlayerViewController.ranking        = ranking;
            rankingPlayerViewController.sortByPosition = (indexPath.row==2);
            
            NSLog(@"rankingPlayerList: %@", ranking.rankingPlayerList);
            
            [self.navigationController pushViewController:rankingPlayerViewController animated:YES];
            [rankingPlayerViewController release];
        }
        
        if( indexPath.row==1 ){
            
            EventViewController *eventViewController = [[EventViewController alloc] initWithStyle:UITableViewStylePlain rankingId:ranking.rankingId];
            
            [self.navigationController pushViewController:eventViewController animated:YES];
            [eventViewController release];
        }
    }
}

- (void)dealloc {
    
    [ranking release];
    [super dealloc];
}

@end
