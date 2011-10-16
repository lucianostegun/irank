//
//  HomeViewController.m
//  iRank
//
//  Created by Luciano Stegun on 01/05/2011.
//  Copyright 2011 __MyCompanyName__. All rights reserved.
//

#import "HomeViewController.h"
#import "Constants.h"
#import "iRankAppDelegate.h"
#import "LoginController.h"
#import "JSON.h"

@implementation HomeViewController

@synthesize bankrollMenuList;
@synthesize tableView;
@synthesize updateIndicator;
@synthesize fee;
@synthesize buyin;
@synthesize rebuy;
@synthesize addon;
@synthesize prize;
@synthesize score;
@synthesize balance;
@synthesize connection;
@synthesize updateButton;

@synthesize appDelegate;
@synthesize loginController;

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
    
    [self updateDataOnline];
    
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

#pragma mark - Resume content
- (void)updateResumeData {
    
//    if( bankrollMenuList==nil )
        bankrollMenuList = [[NSMutableArray alloc] init];
//    else
//        [bankrollMenuList removeAllObjects];
    
    [bankrollMenuList addObject:[NSMutableDictionary 
                                 dictionaryWithObjectsAndKeys:
                                 kBuyinsWord, kSelectKey,
                                 buyin, kDescriptKey,
                                 nil, kControllerKey, nil]];
    [bankrollMenuList addObject:[NSMutableDictionary 
                                 dictionaryWithObjectsAndKeys:
                                 kFeeWord, kSelectKey,
                                 fee, kDescriptKey,
                                 nil, kControllerKey, nil]];
    [bankrollMenuList addObject:[NSMutableDictionary 
                                 dictionaryWithObjectsAndKeys:
                                 kRebuysWord, kSelectKey,
                                 rebuy, kDescriptKey,
                                 nil, kControllerKey, nil]];
    [bankrollMenuList addObject:[NSMutableDictionary 
                                 dictionaryWithObjectsAndKeys:
                                 kAddonsWord, kSelectKey,
                                 addon, kDescriptKey,
                                 nil, kControllerKey, nil]];
    [bankrollMenuList addObject:[NSMutableDictionary 
                                 dictionaryWithObjectsAndKeys:
                                 kPrizesWord, kSelectKey,
                                 prize, kDescriptKey,
                                 nil, kControllerKey, nil]];
    [bankrollMenuList addObject:[NSMutableDictionary 
                                 dictionaryWithObjectsAndKeys:
                                 kBalanceWord, kSelectKey,
                                 balance, kDescriptKey,
                                 nil, kControllerKey, nil]];
}


#pragma mark - Table view data source

- (NSInteger)numberOfSectionsInTableView:(UITableView *)tableView
{

    return 3;
}

- (NSInteger)tableView:(UITableView *)tableView numberOfRowsInSection:(NSInteger)section
{

    switch (section) {
        case 0:
            return 6;
            break;
        case 1:
            return 0;
            break;
        case 2:
            return 0;
            break;
        default:
            break;
    }
    
    return 0;
}

- (UITableViewCell *)tableView:(UITableView *)tableView cellForRowAtIndexPath:(NSIndexPath *)indexPath
{
    static NSString *CellIdentifier = @"Cell";
    
    UITableViewCell *cell = [tableView dequeueReusableCellWithIdentifier:CellIdentifier];
    
    if (cell == nil)
        cell = [[[UITableViewCell alloc] initWithStyle:UITableViewCellStyleValue1 reuseIdentifier:CellIdentifier] autorelease];

        int menuOffset = (indexPath.section*kSection1Rows)+ indexPath.row;
        NSDictionary *cellText = [bankrollMenuList objectAtIndex:menuOffset];
        
        NSString *label = [cellText objectForKey:kSelectKey];
        NSString *description = [cellText objectForKey:kDescriptKey];
        
        cell.textLabel.text       = label;
        cell.detailTextLabel.text = description;
        
        NSPredicate *regExPredicate = [NSPredicate predicateWithFormat:@"SELF MATCHES %@", @"^-.*$"];
        
        if( [regExPredicate evaluateWithObject:description] )
            cell.detailTextLabel.textColor = [UIColor redColor];

    return cell;
}

- (NSString *)tableView:(UITableView *)tableView 
titleForHeaderInSection:(NSInteger)section {
    
    NSString *title = nil;

    switch (section) {
        case 0:
            title = @"Bankroll";
            break;
        case 1:
            title = @"Próximos eventos";
            break;
        case 2:
            title = @"Últimos eventos";
            break;
        default:
            break;
    }
    
    return title;
}

- (NSString *)tableView:(UITableView *)tableView titleForFooterInSection:(NSInteger)section {
    
    NSString *title = nil;
    
    switch (section) {
        case 0:
            title = @"";
            break;
        case 1:
            title = @"Nenhum evento agendado";
            break;
        case 2:
            title = @"Nenhum evento realizado";
            break;
        default:
            break;
    }
    
    return title;
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

    [tableView deselectRowAtIndexPath:indexPath animated:YES];
}




- (void)updateDataOnline {
    
    NSURL *             url;
    NSURLRequest *      request;
    
    NSString *userSiteId = [[NSUserDefaults standardUserDefaults] objectForKey:kUserSiteIdKey];
    NSString *urlString  = [NSString stringWithFormat:@"http://irank/index.php/myAccount/getAppUpdatedData/userSiteId/%@", userSiteId];
    
    url = [NSURL URLWithString:urlString];
    
    request = [NSURLRequest requestWithURL:url];
    connection = [NSURLConnection connectionWithRequest:request delegate:self];
}

- (void)connection: (NSURLConnection *)connection didReceiveResponse:(NSURLResponse *)response {
    
    updateIndicator.hidden = YES;
    updateButton.enabled = YES;
}

- (void)connection: (NSURLConnection *)connection didReceiveData:(NSData *)data {
    
    NSString *result = [[NSString alloc] initWithData:data encoding:NSASCIIStringEncoding];
    
    SBJsonParser *jsonParser = [[SBJsonParser alloc] init];
    NSError *error = nil;
    NSArray *jsonObjects = [jsonParser objectWithString:result error:&error];
    
    fee     = [jsonObjects objectForKey:@"fee"];
    buyin   = [jsonObjects objectForKey:@"buyin"];
    addon   = [jsonObjects objectForKey:@"addon"];
    rebuy   = [jsonObjects objectForKey:@"rebuy"];
    prize   = [jsonObjects objectForKey:@"prize"];
    score   = [jsonObjects objectForKey:@"score"];
    balance = [jsonObjects objectForKey:@"balance"];
    
    [self updateResumeData];
        
    [tableView reloadData];    
}

- (void)connectionDidFinishLoading:(NSURLConnection *)connection {
    
}

- (void)updateData:(id)sender {
    
    updateIndicator.hidden = NO;
    updateButton.enabled = NO;
    [self updateDataOnline];
}

- (void)doLogout:(id)sender {
    
    [appDelegate.defaults removeObjectForKey:kUserSiteIdKey];
    
    if( appDelegate==nil )
        appDelegate = [[UIApplication sharedApplication] delegate];
    
    if( loginController==nil )
        loginController = [LoginController alloc];
    
    appDelegate.window.rootViewController = loginController;
//    [appDelegate.window makeKeyAndVisible];
}

- (void) dealloc {
    
    [bankrollMenuList release];
    [tableView release];
    [updateIndicator release];
    [fee release];
    [buyin release];
    [addon release];
    [rebuy release];
    [prize release];
    [score release];
    [balance release];
    [connection release];
    [updateButton release];
    
    [appDelegate release];
    [loginController release];    
    [super dealloc];
}

@end
