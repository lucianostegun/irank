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
#import "Constants.h"

@implementation EventResultViewController
@synthesize event;
//@synthesize resultDetailViewController;

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
    
    iRankAppDelegate *appDelegate = (iRankAppDelegate *)[[UIApplication sharedApplication] delegate];
    
    int userSiteId = [appDelegate userSiteId];
    
    NSURL *url = [[NSURL alloc] initWithString:[NSString stringWithFormat:@"http://%@/ios.php/event/getXml/model/eventPlayer/userSiteId/%i/eventId/%d", serverAddress, userSiteId, event.eventId]];

    NSXMLParser *xmlParser = [[NSXMLParser alloc] initWithContentsOfURL:url];    
    
    //Inicia o delegate
    XMLEventPlayerParser *parser = [[XMLEventPlayerParser alloc] initXMLParser];
    
    [xmlParser setDelegate:parser];
    
    BOOL success = [xmlParser parse];
    
    if( !success ) 
        return [appDelegate showAlert:@"Erro" message:@"Não foi possível recuperar a lista de jogadores."];
    
    [event setEventPlayerList: [parser getEventPlayerList]];
    [event filterPlayerList];
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

   return (interfaceOrientation == UIInterfaceOrientationLandscapeLeft || interfaceOrientation == UIInterfaceOrientationLandscapeRight);
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
    static NSString *CellIdentifier = @"Cell";
    
    UITableViewCell *cell = [tableView dequeueReusableCellWithIdentifier:CellIdentifier];
    
    if (cell == nil)
        cell = [[[UITableViewCell alloc] initWithStyle:UITableViewCellStyleSubtitle reuseIdentifier:CellIdentifier] autorelease];
    
    
    EventPlayer *eventPlayer = [[event eventPlayerList] objectAtIndex:indexPath.row];
    Player *player = [eventPlayer player];
    
//    NSLog(@"eventPlayer: %@", eventPlayer);
    
    cell.textLabel.text       = [NSString stringWithFormat:@"%iº %@", indexPath.row+1, [player fullName]];
    cell.detailTextLabel.text = [NSString stringWithFormat:@"B: %@ R: %@ A: %@ Prêmio: %@ | %@ pontos", [numberFormatter stringFromNumber:[NSNumber numberWithFloat:eventPlayer.buyin]], [numberFormatter stringFromNumber:[NSNumber numberWithFloat:eventPlayer.rebuy]], [numberFormatter stringFromNumber:[NSNumber numberWithFloat:eventPlayer.addon]], [numberFormatter stringFromNumber:[NSNumber numberWithFloat:eventPlayer.prize]], [numberFormatter stringFromNumber:[NSNumber numberWithFloat:eventPlayer.score]]];
    
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

    EventPlayer *eventPlayer = [[event eventPlayerList] objectAtIndex:indexPath.row];
    
    resultDetailViewController.title = @"Detalhes";
    playerName.text     = [[eventPlayer player] fullName];
    eventPlaceDate.text = [NSString stringWithFormat:@"%@ @%@ - %@ %@", [event eventName], [event eventPlace], [event eventDate], [event startTime]];
    
    position.text       = [NSString stringWithFormat:@"%iº", indexPath.row+1];
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
