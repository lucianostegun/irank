//
//  EventDetailViewController.m
//  iRank
//
//  Created by Luciano Stegun on 01/05/2011.
//  Copyright (c) 2011 __MyCompanyName__. All rights reserved.
//

#import "EventDetailViewController.h"
#import "EventPlayerViewController.h"
#import "EventCommentViewController.h"
#import "EventResultViewController.h"
#import "Constants.h"
#import "iRankAppDelegate.h"

@implementation EventDetailViewController
@synthesize event;

-(id)initWithStyle:(UITableViewStyle)style {
    
    self = [super initWithStyle:UITableViewStyleGrouped];
    
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

    activityIndicator = [[UIActivityIndicatorView alloc] initWithActivityIndicatorStyle:UIActivityIndicatorViewStyleWhite];
    [activityIndicator setHidesWhenStopped:YES];
    [activityIndicator setHidden:YES];
    
    UIBarButtonItem * barButton =  [[UIBarButtonItem alloc] initWithCustomView:activityIndicator];
    
    self.navigationItem.rightBarButtonItem = barButton;
    [barButton release];
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
    [self setTitle:[event eventName]];
    [[self tableView] reloadData];
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

    return 2;
}

- (NSInteger)tableView:(UITableView *)tableView numberOfRowsInSection:(NSInteger)section
{

    int rows = 0;
    
    switch (section) {
        case 0:
            rows = 9;
            break;
        case 1:
            rows = 3;
            if( [event isPastDate] )
                rows = 4;
            
            break;
        default:
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
                label = @"Evento";
                description = event.eventName;
                break;
            case 1:
                label = @"Ranking";
                description = event.rankingName;
                break;
            case 2:
                label = @"Local";
                description = event.eventPlace;
                break;
            case 3:
                label = @"Data";
                description = event.eventDate;
                break;
            case 4:
                label = @"Hora";
                description = event.startTime;
                break;
            case 5:
                label = @"ITM";
                description = [NSString stringWithFormat:@"%i", event.paidPlaces];
                break;
            case 6:
                label = @"Buy-in";
                description = [numberFormatter stringFromNumber:[NSNumber numberWithFloat:event.buyin]];
                break;
            case 7:
                label = @"Rake";
                description = [numberFormatter stringFromNumber:[NSNumber numberWithFloat:event.entranceFee]];
                break;
            case 8:
                label = @"Obs";
                description = event.comments;
                cell.detailTextLabel.font = [UIFont systemFontOfSize:14];
                cell.detailTextLabel.numberOfLines = 4;
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
                label = @"Convidados";
                break;
            case 1:
                label = @"Comentários";
                break;
            case 2:
                label = @"Fotos";
                break;
            case 3:
                label = @"Resultado";
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

- (CGFloat)tableView:(UITableView *)tv heightForRowAtIndexPath:(NSIndexPath *)indexPath {
    
    float height = 0;
    
    switch (indexPath.row) {
        case 8:
            height = 90.0f;
            break;
            
        default:
            height = 44.0f;
            break;
    }
    
    return height;
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

-(UIView *)tableView:(UITableViewCell *)tableView viewForHeaderInSection:(NSInteger)section {

    if( section==0 && !event.isPastDate )
        return [self headerView];
    
    return nil;
}

-(CGFloat)tableView:(UITableView *)tableView heightForHeaderInSection:(NSInteger)section {
    
    if( section==0 && !event.isPastDate )
        return [[self headerView] frame].size.height;

    return 0;
}

#pragma mark - Table view delegate

- (void)tableView:(UITableView *)tableView didSelectRowAtIndexPath:(NSIndexPath *)indexPath
{

    if( indexPath.section==0 )
        return;
    
    switch (indexPath.row) {
        case 0:
                if( eventPlayerViewController==nil )
                    eventPlayerViewController = [[EventPlayerViewController alloc] init];
                
                [eventPlayerViewController setEvent:event];
                
                [eventPlayerViewController setShowEnabledOnly:NO];
            
                [self.navigationController pushViewController:eventPlayerViewController animated:YES];
            break;
        case 1:
            if( eventCommentViewController==nil )
                eventCommentViewController = [[EventCommentViewController alloc] init];
            
            [eventCommentViewController setEventId:event.eventId];
            
            [self.navigationController pushViewController:eventCommentViewController animated:YES];
            break;
        case 2:                
            
            if( photoViewController==nil )
                photoViewController = [[PhotoViewController alloc] init];

            [photoViewController setEventId:event.eventId];
            
            [self.navigationController pushViewController:photoViewController animated:YES];            
            break;
        case 3:                
            
            if( event.isMyEvent && event.isEditable ){
                
                if( eventPlayerViewController==nil )
                    eventPlayerViewController = [[EventPlayerViewController alloc] init];
                
                [eventPlayerViewController setShowEnabledOnly:YES];
                [eventPlayerViewController setEvent:event];
                
                [self.navigationController pushViewController:eventPlayerViewController animated:YES];
            }else{
                
                if( eventResultViewController==nil )
                    eventResultViewController = [[EventResultViewController alloc] initWithNibName:nil bundle:nil];
                
                [eventResultViewController setEvent:event];
                
                [self.navigationController pushViewController:eventResultViewController animated:YES];
            }
            
            break;
        default:
            break;
    }

}

- (void)segmentedControlPressed:(id)sender {
    
    NSString *inviteStatus;
    
    switch ([sender selectedSegmentIndex]) {
        case 0:
            inviteStatus = @"yes";
            break;
        case 2:
            inviteStatus = @"no";
            break;
        default:
            inviteStatus = @"maybe";
            break;
    }
    
    if( [inviteStatus isEqualToString:event.inviteStatus] )
        return;
    
    [activityIndicator startAnimating];
    [activityIndicator setHidden:NO];
    
    int userSiteId = [(iRankAppDelegate *)[[UIApplication sharedApplication] delegate] userSiteId];
    
    NSURL *url = [NSURL URLWithString:[NSString stringWithFormat:@"http://%@/ios.php/event/updateInviteStatus/userSiteId/%i/eventId/%i/inviteStatus/%@", serverAddress, userSiteId, event.eventId, inviteStatus]];
    
    NSURLRequest *request = [NSURLRequest requestWithURL:url];
    
    [NSURLConnection connectionWithRequest:request delegate:self];
//    NSLog(@"url: %@", url.relativeString);
//    [[self navigationItem] setHidesBackButton:YES];
}

- (void)connection: (NSURLConnection *)connection didReceiveResponse:(NSURLResponse *)response {
    
//    NSLog(@"didReceiveResponse: %@", response.description);
    [activityIndicator stopAnimating];
}

- (void)connection: (NSURLConnection *)connection didReceiveData:(NSData *)data {
    
    NSString *result = [[NSString alloc] initWithData:data encoding:NSASCIIStringEncoding];
    
    
    if( [result isEqualToString:@"yes"] || [result isEqualToString:@"no"] )
        event.inviteStatus = result;
    else
        event.inviteStatus = @"none";
    
    NSLog(@"result: %@", result);
}

- (void)connectionDidFinishLoading:(NSURLConnection *)connection {
    
}

-(UIView *)headerView {
    
    if( headerView )
        return headerView;
    
    NSArray *itemList = [[NSArray alloc] initWithObjects:@"Vou", @"Talvez", @"Não vou", nil];
    // Create a UIButton object, simple rounded rect style
    UISegmentedControl *segmentedControl = [[UISegmentedControl alloc] initWithItems:itemList];
    segmentedControl.segmentedControlStyle = UISegmentedControlStyleBar;
//    segmentedControl.tintColor = [UIColor blackColor];
    
    // Set the title of this button to "Edit"
//    [editButton setTitle:@"Edit" forState:UIControlStateNormal];
    
    // How wide is the screen?
    float w = [[UIScreen mainScreen] bounds].size.width;
    
    // Create a rectangle for the button
    CGRect segmentedControlFrame = CGRectMake(8.0, 8.0, w - 16.0, 30);
    [segmentedControl setFrame:segmentedControlFrame];
    
    // When this button is tapped, send the message
    // editingButtonPressed: to this instance of ItemsViewController
    
    // Create a rectangle for the headerView that will contain the button
    CGRect headerViewFrame = CGRectMake(0, 0, w, 48);
    headerView = [[UIView alloc] initWithFrame:headerViewFrame];
    
    // Add button to the headerView's view hierarchy
    [headerView addSubview:segmentedControl];
    
    if( [event.inviteStatus isEqualToString:@"yes"] )
        [segmentedControl setSelectedSegmentIndex:0];
    else if( [event.inviteStatus isEqualToString:@"no"] )
        [segmentedControl setSelectedSegmentIndex:2];
    else
        [segmentedControl setSelectedSegmentIndex:1];
    
    [segmentedControl addTarget:self action:@selector(segmentedControlPressed:) forControlEvents:UIControlEventValueChanged];
    
    return headerView;
}

-(void)dealloc {
    
    [event release];
    [eventPlayerViewController release];
    [super dealloc];
}

@end
