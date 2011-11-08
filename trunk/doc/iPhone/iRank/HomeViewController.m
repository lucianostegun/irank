//
//  HomeViewController.m
//  iRank
//
//  Created by Luciano Stegun on 01/05/2011.
//  Copyright 2011 __MyCompanyName__. All rights reserved.
//

#import "HomeViewController.h"
#import "iRankAppDelegate.h"
#import "Constants.h"
#import "Event.h"
#import "XMLEventParser.h"
#import "EventDetailViewController.h"

@implementation HomeViewController

@synthesize bankrollInfo;
@synthesize nextEventList, previousEventList;
@synthesize eventDetailViewController;

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
    
    self.navigationController.navigationBar.barStyle = UIBarStyleBlackOpaque;
    self.navigationItem.leftBarButtonItem = quitButton;
    
    [self updateResume];
}

-(void)updateResume {
    
    iRankAppDelegate *appDelegate = (iRankAppDelegate *)[[UIApplication sharedApplication] delegate];
    NSMutableDictionary *userInfo = [[appDelegate userDefaults] objectForKey:@"userInfo"];
    
    bankrollInfo = [[NSMutableArray alloc] init];
    
    [bankrollInfo addObject:[NSMutableDictionary
                                 dictionaryWithObjectsAndKeys:
                                 kBuyinsWord, kSelectKey,
                                 [userInfo valueForKey:kBuyinKey], kDescriptKey,
                                 nil, kControllerKey, nil]];
    [bankrollInfo addObject:[NSMutableDictionary
                                 dictionaryWithObjectsAndKeys:
                                 kFeeWord, kSelectKey,
                                 [userInfo valueForKey:kFeeKey], kDescriptKey,
                                 nil, kControllerKey, nil]];
    [bankrollInfo addObject:[NSMutableDictionary
                                 dictionaryWithObjectsAndKeys:
                                 kRebuysWord, kSelectKey,
                                 [userInfo valueForKey:kRebuyKey], kDescriptKey,
                                 nil, kControllerKey, nil]];
    [bankrollInfo addObject:[NSMutableDictionary
                                 dictionaryWithObjectsAndKeys:
                                 kAddonsWord, kSelectKey,
                                 [userInfo valueForKey:kAddonKey], kDescriptKey,
                                 nil, kControllerKey, nil]];
    [bankrollInfo addObject:[NSMutableDictionary
                                 dictionaryWithObjectsAndKeys:
                                 kPrizesWord, kSelectKey,
                                 [userInfo valueForKey:kPrizeKey], kDescriptKey,
                                 nil, kControllerKey, nil]];
    [bankrollInfo addObject:[NSMutableDictionary
                                 dictionaryWithObjectsAndKeys:
                                 kBalanceWord, kSelectKey,
                                 [userInfo valueForKey:kBalanceKey], kDescriptKey,
                                 nil, kControllerKey, nil]];
    
    NSNumber *homeEvents = [[appDelegate userDefaults] objectForKey:@"homeEvents"];
    
    int userSiteId = [appDelegate userSiteId];
    
    NSURL *url = [[NSURL alloc] initWithString:[NSString stringWithFormat:@"http://%@/ios.php/event/getXml/model/nextEvents/userSiteId/%i", serverAddress, userSiteId]];
    NSXMLParser *xmlParser = [[NSXMLParser alloc] initWithContentsOfURL:url];    
    
    //Inicia o delegate
    XMLEventParser *parser = [[XMLEventParser alloc] initXMLParser];
    
    [xmlParser setDelegate:parser];
    
    BOOL success = [xmlParser parse];
    
    nextEventList = [[parser getEventList] copy];

    [parser resetEventList];

    url = [[NSURL alloc] initWithString:[NSString stringWithFormat:@"http://%@/ios.php/event/getXml/model/previousEvents/userSiteId/%i/limit/%@", serverAddress, userSiteId, homeEvents]];
    xmlParser = [xmlParser initWithContentsOfURL:url];    
    success = [xmlParser parse];
    
    previousEventList = [[parser getEventList] copy];

    if( [nextEventList count] > 0 ){
        
        appDelegate.homeTabBar.badgeValue = [NSString stringWithFormat:@"%i", [nextEventList count]];
        [appDelegate incraseBadge:[nextEventList count]];
    }
    
//    [homeEvents release];
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

    return 3;
}

- (NSInteger)tableView:(UITableView *)tableView numberOfRowsInSection:(NSInteger)section
{

    int rows = 0;

    switch (section) {
        case 0:
            rows = 6;
            break;
        case 1:
            rows = [nextEventList count];
            break;
        case 2:
            rows = [previousEventList count];
            break;
        default:
            break;
    }
    
    return rows;
}

- (UITableViewCell *)tableView:(UITableView *)tableView cellForRowAtIndexPath:(NSIndexPath *)indexPath
{
    
    NSString *CellIdentifier = [NSString stringWithFormat:@"CellX%d", indexPath.section];
    
    UITableViewCell *cell = [tableView dequeueReusableCellWithIdentifier:CellIdentifier];
    
    if (cell == nil){
        
        if( indexPath.section==0 )
            cell = [[[UITableViewCell alloc] initWithStyle:UITableViewCellStyleValue1 reuseIdentifier:CellIdentifier] autorelease];
        else
            cell = [[[UITableViewCell alloc] initWithStyle:UITableViewCellStyleSubtitle reuseIdentifier:CellIdentifier] autorelease];
    }
    
    NSString *label = [[[NSString alloc] init] autorelease];
    NSString *description = [[[NSString alloc] init] autorelease];
    
    if( indexPath.section==0 ){
        
        NSDictionary *cellText = [bankrollInfo objectAtIndex:indexPath.row];
        
        label       = [cellText objectForKey:kSelectKey];
        description = [cellText objectForKey:kDescriptKey];
        
        NSPredicate *regExPredicate = [NSPredicate predicateWithFormat:@"SELF MATCHES %@", @"^-.*$"];
        
        if( [regExPredicate evaluateWithObject:description] )
            cell.detailTextLabel.textColor = [UIColor redColor];
        
        cell.selectionStyle = UITableViewCellSelectionStyleNone;
    }else{
        
        Event *event;
        
        if( indexPath.section==1 )
            event = [[nextEventList objectAtIndex:indexPath.row] retain];
        else
            event = [[previousEventList objectAtIndex:indexPath.row] retain];

        label       = [event eventName];
        description = [NSString stringWithFormat:@"@%@ - %@ %@", [event eventPlace], [event eventDate], [event startTime]];
        cell.accessoryType = UITableViewCellAccessoryDisclosureIndicator;
        
        [event release];
    }
    
    cell.textLabel.text       = label;
    cell.detailTextLabel.text = description;
        
    return cell;
}

- (NSString *)tableView:(UITableView *)tableView titleForHeaderInSection:(NSInteger)section {
    
    NSString *header = [[[NSString alloc] init] autorelease];
    
    switch (section) {
        case 0:
            header = @"Resumo geral";
            break;
        case 1:
            header = @"Próximos eventos";
            break;
        case 2:
            header = @"Últimos eventos";
            break;
        default:
            break;
    }
    
    return header;
}

- (NSString *)tableView:(UITableView *)tableView titleForFooterInSection:(NSInteger)section {
    
    NSString *footer = [[[NSString alloc] init] autorelease];
    
    switch (section) {
        case 0:
            footer = nil;
            break;
        case 1:
            if( [nextEventList count]==0 )
                footer = @"Nenhum evento agendado";
            break;
        case 2:
            if( [previousEventList count]==0 )
                footer = @"Nenhum evento realizado";
            break;
        default:
            break;
    }
    
    return footer;
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

    if( indexPath.section > 0 ){
        
        if( !eventDetailViewController )
            eventDetailViewController = [[EventDetailViewController alloc] init];
        
        Event *event;
        
        if( indexPath.section==1 )
            event = [[nextEventList objectAtIndex:indexPath.row] retain];
        else
            event = [[previousEventList objectAtIndex:indexPath.row] retain];
        
        [eventDetailViewController setEvent:event];
        [self.navigationController pushViewController:eventDetailViewController animated:YES];
        
        [event release];
    }
}

#pragma mark - Custom actions

- (void)doLogout:(id)sender {
    
    iRankAppDelegate *appDelegate = (iRankAppDelegate *)[[UIApplication sharedApplication] delegate];

    [appDelegate showLogin];
        
    [[appDelegate userDefaults] removeObjectForKey:@"userInfo"]; 
    [[appDelegate userDefaults] synchronize];
}

- (void)dealloc {
    
    [bankrollInfo release];
    [nextEventList release];
    [previousEventList release];
    [eventDetailViewController release];
    [super dealloc];
}
@end
