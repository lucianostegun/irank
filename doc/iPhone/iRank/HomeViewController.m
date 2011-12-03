//
//  HomeViewController.m
//  iRank
//
//  Created by Luciano Stegun on 01/05/2011.
//  Copyright 2011 __MyCompanyName__. All rights reserved.
//

#import "HomeViewController.h"
#import "iRankAppDelegate.h"
#import "Event.h"
#import "XMLEventParser.h"
#import "EventDetailViewController.h"
#import "JSON.h"

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
    
    self.hidesBottomBarWhenPushed = YES;

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
    
    UIBarButtonItem *reloadButton = [[UIBarButtonItem alloc] initWithTitle:@"atualizar" style:UIBarButtonItemStylePlain target:self action:@selector(reloadData:)];
    
    self.navigationController.navigationBar.barStyle = UIBarStyleBlackOpaque;
    self.navigationItem.rightBarButtonItem = reloadButton;
    self.navigationItem.leftBarButtonItem = quitButton;
    
    bankrollInfo = [[NSMutableArray alloc] init];

    [self updateResume];
    
    [self reloadData];
}

-(void)updateResume {
    
    NSMutableDictionary *userInfo = [[appDelegate userDefaults] objectForKey:@"userInfo"];
    
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
    
    appDelegate.refreshHome = NO;
}

- (void)updateEventList {
    
    int userSiteId = [appDelegate userSiteId];

    int homeEvents = [[[appDelegate userDefaults] objectForKey:kHomeEventLimitKey] intValue];
    
    NSMutableArray *eventList = [Event loadEventList:@"resume" userSiteId:userSiteId limit:homeEvents];
    
    NSLog(@"eventList count: %i", [eventList count]);
    
    nextEventList     = [[NSMutableArray alloc] init];
    previousEventList = [[NSMutableArray alloc] init];
    
    for(Event *event in eventList){
        
        if( event.isPastDate )
            [previousEventList addObject:event];
        else
            [nextEventList addObject:event];
    }
    
    [eventList release];
    
    [[UIApplication sharedApplication] setNetworkActivityIndicatorVisible:NO];
    
    if( [nextEventList count] > 0 ){
        
        appDelegate.homeTabBar.badgeValue = [NSString stringWithFormat:@"%i", [nextEventList count]];
        [appDelegate incraseBadge:[nextEventList count]];
    }

    [[self tableView] reloadData];
    [appDelegate hideLoadingView];
//    [loadingView removeFromSuperview];
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
    
    self.hidesBottomBarWhenPushed = NO;
    eventDetailViewController.hidesBottomBarWhenPushed = NO;
    
    if( appDelegate.refreshHome ){
        
        [appDelegate showLoadingView:nil];
        [self performSelector:@selector(reloadResumeData) withObject:nil afterDelay:0.1];
    }
    
//    if( appDelegate.refreshHomeEventList )
//        [self updateResume];
}

- (void)reloadResumeData {
    
    int userSiteId = [appDelegate userSiteId];
    NSURL *url                   = [NSURL URLWithString:[NSString stringWithFormat:@"http://%@/ios.php/login/getInfo/userSiteId/%i", serverAddress, userSiteId]];
    NSMutableURLRequest *request = [NSMutableURLRequest requestWithURL:url cachePolicy:NSURLRequestReloadIgnoringCacheData timeoutInterval:45];
  	NSError *requestError        = nil;
    NSData *response             = [NSURLConnection sendSynchronousRequest:request returningResponse:nil error:&requestError]; 
    NSString *result             = [[NSString alloc] initWithData:response encoding:NSASCIIStringEncoding];
    
    if( requestError!=nil )
        return;
    
//    NSLog(@"result: %@", result);
    
    [bankrollInfo removeAllObjects];
        
    NSMutableDictionary *dictionary = [[NSMutableDictionary alloc] initWithDictionary:[[appDelegate userDefaults] objectForKey:@"userInfo"]];
//    
    SBJsonParser *jsonParser = [[SBJsonParser alloc] init];
    NSDictionary *jsonObjects = [jsonParser objectWithString:result error:nil];
    
    [dictionary setObject:[jsonObjects objectForKey:kFeeKey] forKey:kFeeKey];
    [dictionary setObject:[jsonObjects objectForKey:kBuyinKey] forKey:kBuyinKey];
    [dictionary setObject:[jsonObjects objectForKey:kAddonKey] forKey:kAddonKey];
    [dictionary setObject:[jsonObjects objectForKey:kRebuyKey] forKey:kRebuyKey];
    [dictionary setObject:[jsonObjects objectForKey:kPrizeKey] forKey:kPrizeKey];
    [dictionary setObject:[jsonObjects objectForKey:kScoreKey] forKey:kScoreKey];
    [dictionary setObject:[jsonObjects objectForKey:kBalanceKey] forKey:kBalanceKey];
    
    
    [bankrollInfo addObject:[NSMutableDictionary
                             dictionaryWithObjectsAndKeys:
                             kBuyinsWord, kSelectKey,
                             [dictionary valueForKey:kBuyinKey], kDescriptKey,
                             nil, kControllerKey, nil]];
    [bankrollInfo addObject:[NSMutableDictionary
                             dictionaryWithObjectsAndKeys:
                             kFeeWord, kSelectKey,
                             [dictionary valueForKey:kFeeKey], kDescriptKey,
                             nil, kControllerKey, nil]];
    [bankrollInfo addObject:[NSMutableDictionary
                             dictionaryWithObjectsAndKeys:
                             kRebuysWord, kSelectKey,
                             [dictionary valueForKey:kRebuyKey], kDescriptKey,
                             nil, kControllerKey, nil]];
    [bankrollInfo addObject:[NSMutableDictionary
                             dictionaryWithObjectsAndKeys:
                             kAddonsWord, kSelectKey,
                             [dictionary valueForKey:kAddonKey], kDescriptKey,
                             nil, kControllerKey, nil]];
    [bankrollInfo addObject:[NSMutableDictionary
                             dictionaryWithObjectsAndKeys:
                             kPrizesWord, kSelectKey,
                             [dictionary valueForKey:kPrizeKey], kDescriptKey,
                             nil, kControllerKey, nil]];
    [bankrollInfo addObject:[NSMutableDictionary
                             dictionaryWithObjectsAndKeys:
                             kBalanceWord, kSelectKey,
                             [dictionary valueForKey:kBalanceKey], kDescriptKey,
                             nil, kControllerKey, nil]];
    
    [[appDelegate userDefaults] setObject:dictionary forKey:@"userInfo"];
    [[appDelegate userDefaults] synchronize];
//    
//    NSLog(@"dictionary: %@", dictionary);
////    [dictionary release];
//    
    [self updateResume];
    [[self tableView] reloadData];
    [appDelegate hideLoadingView];
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

- (void)reloadData:(id)sender {
    
    [self reloadResumeData];
    [self reloadData];
}

- (void)reloadData {
    
    [appDelegate showLoadingView:nil];
    [self performSelector:@selector(updateEventList) withObject:nil afterDelay:0.1];
}

- (BOOL)shouldAutorotateToInterfaceOrientation:(UIInterfaceOrientation)interfaceOrientation
{
    
    // Return YES for supported orientations
    return YES;//(interfaceOrientation == UIInterfaceOrientationPortrait);
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
        else{
            
            if( indexPath.row==5 )
                cell.detailTextLabel.textColor = [UIColor blueColor];
            else
                cell.detailTextLabel.textColor = [UIColor blackColor];
        }
        
        cell.selectionStyle = UITableViewCellSelectionStyleNone;
    }else{
        
        Event *event;
        
        if( indexPath.section==1 )
            event = [[nextEventList objectAtIndex:indexPath.row] retain];
        else
            event = [[previousEventList objectAtIndex:indexPath.row] retain];

        label       = [event eventName];
        description = [NSString stringWithFormat:@"%@ %@ @%@", [event eventDate], [event startTime], [event eventPlace]];
        cell.accessoryType = UITableViewCellAccessoryDisclosureIndicator;
        
        if( event.hasOfflineResult ){
            
            cell.detailTextLabel.textColor = [UIColor orangeColor];
            description = @"Resultado offline pendente...";
        }else if( event.isPastDate && !event.savedResult ){
            
            cell.detailTextLabel.textColor = [UIColor redColor];
            description = @"Resultado pendente...";
        }else{
            
            cell.detailTextLabel.textColor = [UIColor blackColor];
        }
        
        [event release];
    }
    
    cell.textLabel.text       = label;
    cell.detailTextLabel.text = description;
        
    return cell;
}

- (NSString *)tableView:(UITableView *)tableView titleForHeaderInSection:(NSInteger)section {
    
    NSString *header = [[[NSString alloc] init] autorelease];

    NSString *firstName = appDelegate.firstName;
    NSString *lastName  = appDelegate.lastName;
    
    switch (section) {
        case 0:
            header = [NSString stringWithFormat:@"Olá %@ %@\n\nResumo geral", firstName, lastName];
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
        
        eventDetailViewController.hidesBottomBarWhenPushed = YES;
        
        [eventDetailViewController setEvent:event];
        [self.navigationController pushViewController:eventDetailViewController animated:YES];
        
        [event release];
    }
}

#pragma mark - Custom actions

- (void)doLogout:(id)sender {
    
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
